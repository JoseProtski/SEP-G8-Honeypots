import re
import mysql.connector
from mysql.connector import Error
import os

#connect to MYSQL DB
def connect():
    conn = None
    try:
        conn = mysql.connector.connect(host='localhost',
                                       database='logs',
                                       user='root',
                                       password='root',
                                       allow_local_infile=True)
        if conn.is_connected():
            query = "load data local infile '/packetlog.txt' into table packetlog";
            mycursor = conn.cursor()
            mycursor.execute(query)
            conn.commit()

    except Error as e:
        print(e)
    finally:
        if conn is not None and conn.is_connected():
            conn.close()

def read_web_logfile():
    with open("/var/log/remotelogs/webserver/packet-logging.log", "r") as log_file:
        lines = log_file.readlines()
        r = re.compile(".*webserver packet-logging:")
        secondlist = list(filter(r.match, lines))
        return secondlist

#Read log file into list (system Server)
def read_logfile():
    with open("/var/log/remotelogs/systemserver/packet-logging.log", "r") as log_file:
        lines = log_file.readlines()
        r = re.compile(".*systemserver packet-logging:")
        newlist = list(filter(r.match,lines))
        return newlist

def formatLogs(newlist):
    time = "+10:00"
    T = "T"
    packetLogging = "packet-logging:"
    dDrop = "]:"
    defaultDrop = "[default-drop"
    addTabbHost1 = "systemserver"
    addTabbHost2 = "webserver"
    ssh = "[ssh]"
    newlist =  [sub.replace(packetLogging, "\t") for sub in newlist]
    newlist = [sub.replace(dDrop, "\t") for sub in newlist]
    newlist = [sub.replace(defaultDrop, "default drop") for sub in newlist]
    newlist = [sub.replace(time, "\t") for sub in newlist]
    newlist = [sub.replace(T, "\t",1) for sub in newlist]
    newlist = [sub.replace(addTabbHost1, "\tsystemserver") for sub in newlist]
    newlist = [sub.replace(addTabbHost2, "\twebserver") for sub in newlist]
    newlist = [sub.replace(ssh, "ssh\t") for sub in newlist]
 #   newlist = [string.replace(T,
    return newlist

def add_to_beginning(s, tab="\t"):
    return tab + s

#write to text file
def write_formatted_logs(newlist):
    file=open("/packetlog.txt","w")
    for x in newlist:
        file.writelines(x)
    file.close()

#clear log file after it has been inserted into the database
def clearLogs():
    os.system("truncate -s 0 /var/log/remotelogs/systemserver/packet-logging.log")
    os.system("truncate -s 0 /var/log/remotelogs/webserver/packet-logging.log")


if __name__ == '__main__':
    secondlist = read_web_logfile()
    newlist = read_logfile()
    newlist = newlist + secondlist
    r = re.compile("[a-zA-Z]{3}\s[0-9]{1}[0-9]{1}\s[0-9]{1}[0-9]{1}:[0-9]{1}[0-9]{1}:[0-9]{1}[0-9]{1}\ssystemserver")
    newlist = [re.sub(r, "", i) for i in newlist]
    r = re.compile("[a-zA-Z]{3}\s[0-9]{1}[0-9]{1}\s[0-9]{1}[0-9]{1}:[0-9]{1}[0-9]{1}:[0-9]{1}[0-9]{1}\swebserver")
    newlist = [re.sub(r, "", i) for i in newlist]
    newlist = formatLogs(newlist)
    newlist = list(map(add_to_beginning, newlist))
    write_formatted_logs(newlist)
    connect()
    clearLogs()