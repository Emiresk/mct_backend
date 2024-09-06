import requests
from bs4 import BeautifulSoup

# URL страницы с данными
url = 'https://oilprice.com.ua/ru/kiev/'

headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36"
}
# Отправляем GET запрос
session = requests.Session()

response = session.get(url, headers=headers)

# Проверяем успешность запроса
if response.status_code == 200:
    # Разбираем страницу с помощью BeautifulSoup
    soup = BeautifulSoup(response.content, "html.parser")

    # Ищем таблицу с ценами на топливо
    table = soup.find("tbody", class_="refuelContent")

    print(table)
    # Получаем строки таблицы
    rows = table.find_all("tr")

    # Создаем список для хранения данных
    fuel_data = []

    # Проходимся по каждой строке таблицы
    for row in rows:
        brand = row.find("span").text.strip()
        prices = {}
        prices["azs_name"] = brand
        prices["a95plus"] = row.find("td", class_="a95p").text.strip()
        prices["a95"] = row.find("td", class_="a95").text.strip()
        prices["a92"] = row.find("td", class_="a92").text.strip()
        prices["dp"] = row.find("td", class_="dt").text.strip()
        prices["lpg"] = row.find("td", class_="gaz").text.strip()
        fuel_data.append(prices)

    # Печатаем результат
    for item in fuel_data:
        print(item)
else:
    print("Не удалось получить данные с сайта. Код ошибки:", response.status_code)
