import requests;

class Cls:
    """
    def __new__(self):
        print('init cls')
    """
    def foo(self):
        print("foo in Cls")
        """ invoke first"""
        req = requests.request("GET","http://www.baidu.com")
        print(req.headers)
        self.bar()
        
    def bar(self):
        print("bar in cls")
        pass
        
        
        
cls = Cls()

cls.foo()
cls.bar()