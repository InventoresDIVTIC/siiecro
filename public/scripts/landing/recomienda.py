import sys
import json
import pandas as pd
import string
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
from stop_words import get_stop_words

# Se verifica que solo vengan los parámetros necesarios para el script
if len(sys.argv) == 4:
    id_obra         = int(sys.argv[1])
    ruta_csv        = sys.argv[2]
    cantidad_obras  = int(sys.argv[3])
else:
    # print("Error - Introduce los argumentos correctamente")
    # exit()
    id_obra         =   1
    ruta_csv        =   "C:/wamp64/www/siiecro/public/resources/obras.csv"
    cantidad_obras  =   10

stop_words = get_stop_words('spanish')
# se genera el dataframe con el que se trabajará
df      = pd.read_csv(ruta_csv);

# se hace una limpieza de datos, tanto de los tags como de los ids de la obras 
# quitando datos nulos como signos de puntuasion
df['tags']      = df['tags'].str.replace('[{}]'.format(string.punctuation), '')
df['tags']      = df['tags'].fillna('')
df['id']        = df['id'].fillna(0).astype(int)

tfidf           = TfidfVectorizer(stop_words=stop_words)
matriz_tfidf    = tfidf.fit_transform(df['tags'])
similitudes     = cosine_similarity(matriz_tfidf, matriz_tfidf)
indices         = pd.Series(df.index, index = df['id']).drop_duplicates()

try:
    idx                 = indices[id_obra]
    relacionados        = list(enumerate(similitudes[idx]))
    relacionados        = sorted(relacionados, key = lambda x: x[1], reverse = True)
    
    # en esta linea se le especifica un cierto error o cantidad de términos
    # u obras encontrados como los más similares o más cercanos al término buscado
    relacionados        = relacionados[1:cantidad_obras+1]
    indices_terminos    = [i[0] for i in relacionados]
    
    # se encuentran los indices de los términos más cercanos encontrados
    sugeridos           = df.iloc[indices_terminos]['id'].to_json(orient = "records")
    parsed              = json.loads(sugeridos)
    # se retorna el resultado en formato json
    print(json.dumps(parsed, indent=4)) 
except Exception as e:  # guardamos la excepción como una variable e
    # print("Ha ocurrido un error =>", type(e).__name__)
    # print('El término no existe')
    print([])