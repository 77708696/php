import mysql.connector
from datetime import date, datetime, timedelta

'''
参考
http://dev.mysql.com/doc/connectors/en/connector-python-example-cursor-transaction.html

'''


cnx = mysql.connector.connect(user='root', password='123456',
                              host='127.0.0.1',
                              database='testdb')
cursor = cnx.cursor()
add_employee = ("INSERT INTO trash "
               "(trash_id, user_id, document_id, type, deleted_time) "
               "VALUES (%s, %s, %s, %s, %s)")
data_employee = ('Geert111', 'Vanderkelen', '1111', 'card', date(1977, 6, 14))

add_trash = ("INSERT INTO trash (trash_id, user_id, document_id, type, deleted_time) "
            " VALUES (%(trash)s, %(userid)s, %(document)s, %(type)s), current_date())")
data_trash = {
    'trash': 'aaaa',
    'userid': 'userid',
    'document': 'aaa',
    'type': 'aacc'
    }
  
'''
cursor.execute(add_trash, data_trash)
'''
cursor.execute(add_employee, data_employee)
cnx.commit()
cursor.close()
cnx.close()