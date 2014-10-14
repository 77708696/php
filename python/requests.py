import requests

session = requests.session()

res = session.post("http://www.yipu.com.cn")

print(res.text)
