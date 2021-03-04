import sys
import json
import pandas as pd
import string

# Se verifica que solo vengan los parámetros necesarios para el script
if len(sys.argv) == 3:
    obra_id         = sys.argv[1]
    conocimientos   = sys.argv[2]
else:
    print("Error - Introduce los argumentos correctamente")
    print('Ejemplo: recomienda.py "id de la obra" "Base de conocimientos"')

id_obra = obra_id
# se convierte la base de conocimientos de string a json
parsed  = json.loads(conocimientos)
# se genera el dataframe con el que se trabajará
Df      = pd.DataFrame(parsed)
# se toma solo un porcentaje de la base de conocimientos, este parámetro se puede reajustar
df      = Df.sample(frac=0.5)
df      = Df.reset_index(drop=True)

# se hace una limpieza de datos, tanto de los tags como de los ids de la obras 
# quitando datos nulos como signos de puntuasion
df['ntags']     = df['TAGS_OBRAS'].str.replace('[{}]'.format(string.punctuation), ' ')
df['ID_OBRAS']  = df['ID_OBRAS'].fillna(0).astype(int)

'''
“Term Frequency times Inverse Document Frequency”, 
o “frecuencia del término por frecuencia inversa de documento”.

Support Vector Machine:
    Las máquinas de vectores de soporte son una técnica de machine learning 
    que encuentra la mejor separación posible entre clases. 
    Con dos dimensiones es fácil entender lo que está haciendo. Normalmente, 
    los problemas de aprendizaje automático tienen muchísimas dimensiones. 
    Así que en vez de encontrar la línea óptima, 
    el SVM encuentra el hiperplano que maximiza el margen de separación entre clases.
'''
from sklearn.feature_extraction.text import TfidfVectorizer
tfidf = TfidfVectorizer(stop_words='spanish')
tfidf = TfidfVectorizer()

df['ntags'] = df['ntags'].fillna('')
'''
# tokenizar y construir vocabulario sobre el cual se hará el entrenamiento del modelo
# en este paso se le pasa la columna de tags que utilizamos para entrenar nuestro modelo
# a este concepto se le conoce dentro de la Inteligencia artificial como 
Machine Learning o
APRENDIZAJE AUTOMÁTICO, en este caso SUPERVISADO:
    ya que se le dan datos para entrenar al modelo, y mientras más datos se le den
    puede ir aprendiendo automáticamente, ya que tendrá una mayor fuente de información
    de la cual aprender y ser más preciso

Se le pasan los parámetros para ser vectorizados
'''
tfidf_matrix = tfidf.fit_transform(df['ntags'])

from sklearn.metrics.pairwise import linear_kernel
'''
Una vez vectorizadas las etiquetas 
pedimos que nos devuelva la similaridad encontrada
Buscando son el algoritmo de SIMILARIDAD DEL COSENO
'''
cosine_sim  = linear_kernel(tfidf_matrix, tfidf_matrix)

indices     = pd.Series(df.index, index = df['ID_OBRAS']).drop_duplicates()

def getRecomendations(nombre, cosine_sim = cosine_sim):
    try:
        idx                 = indices[nombre]
        sim_scores          = list(enumerate(cosine_sim[idx]))
        sim_scores          = sorted(sim_scores, key = lambda x: x[1], reverse = True)
        # en esta linea se le especifica un cierto error o cantidad de términos
        # u obras encontrados como los más similares o más cercanos al término buscado
        sim_scores          = sim_scores[1:3]
        indices_terminos    = [i[0] for i in sim_scores]
        # se encuentran los indices de los términos más cercanos encontrados
        sugeridos           = df.iloc[indices_terminos]['ID_OBRAS'].to_json(orient="records")
        parsed              = json.loads(sugeridos)
        # se retorna el resultado en formato json
        return json.dumps(parsed, indent=4) 
    except Exception as e:  # guardamos la excepción como una variable e
        print("Ha ocurrido un error =>", type(e).__name__)
        print('El término no existe')
        return json.dumps([])

print(getRecomendations(int(id_obra)))