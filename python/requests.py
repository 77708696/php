import httplib2
h = httplib2.Http('.cache')
    
response,content = h.request('http://192.168.30.191/contact?contact=&vcardid=')
#for item in response.items(): print(item)
print(content.decode('utf-8'))
