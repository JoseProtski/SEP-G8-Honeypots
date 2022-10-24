import re
import mysql.connector
from mysql.connector import Error
import os
#connect to MySQL database
def connect():
    conn = None
    try:
        conn = mysql.connector.connect(host='localhost',
                                       database='logs',
                                       user='root',
                                       password='root',
                                       allow_local_infile=True)
        if conn.is_connected():
         #   print('Connected to MySQL database')
            query = "load data local infile '/testlog.txt' into table command_logs;"
            mycursor = conn.cursor()
            mycursor.execute(query)
            conn.commit()


    except Error as e:
        print(e)
    finally:
        if conn is not None and conn.is_connected():
            conn.close()


#Read the web server command logs into a list
def read_web_logfile():
    with open("/var/log/remotelogs/webserver/command-logging.log", "r") as logFile:
        logs = logFile.readlines()
        r = re.compile(".*webserver command-logging:")
        secondlist = list(filter(r.match, logs))
        return secondlist


#Reads the command log file into list (System Server)
def read_logfile():
    with open("/var/log/remotelogs/systemserver/command-logging.log", "r") as log_file:
        lines = log_file.readlines()
        r = re.compile(".*systemserver command-logging:")
        newlist = list(filter(r.match, lines))
        return newlist

def remove_snoopy_id(newlist):
    snoopyID = re.compile("\[[0-9]+\]")
    for sub in newlist:
        newlist = re.sub(snoopyID, "", sub)
#formats the logs so they are suitable for insertion into database
def formatLogs(newlist):
    time = "+10:00"
    capitalT = "T"
    commandLogging = "command-logging:"
    removeTabbed = "TABBED"
    addTabHost1 = "systemserver"
    addTabHost2 = "webserver"
    changeUser = "user-1000"
    newlist = [sub.replace(removeTabbed, "\t") for sub in newlist]
    newlist = [sub.replace(time, "\t") for sub in newlist]
    newlist = [sub.replace(capitalT, "\t",1) for sub in newlist]
    newlist = [sub.replace(commandLogging, "\t") for sub in newlist]
    newlist = [sub.replace(addTabHost1, "\tsystemserver") for sub in newlist]
    newlist = [sub.replace(addTabHost2, "\twebserver") for sub in newlist]
    newlist = [sub.replace(changeUser, "admin")  for sub in newlist]
    return newlist
#writes the formatted logs to a text file which is used for insertion into table
def write_formatted_logs(newlist):
    file=open("/testlog.txt", "w")
    for x in newlist:
        file.writelines(x)
    file.close()

#so logs that are not needed making it through, using this function to filter t>
def remove_log(filtered):
    r = re.compile(".*env -i LANG=C.UTF-8 LANGUAGE= LC_CTYPE= LC_NUMERIC= LC_TI")
    voidLog1 = re.compile(".*start-stop-daemon")
    voidLog2 = re.compile(".*env -i")
    voidLog3 = re.compile(".*message repeated")
    voidLog4 = re.compile(".*usr")
    voidLog5 = re.compile(".*grep")
    voidLog6 = re.compile(".*basename")
    voidLog7 = re.compile(".*run-parts")
    voidLog8 = re.compile(".*ln -sf /run/rsyslogd.pid")
    filtered = [i for i in newlist if not r.match(i)]
    filtered = [i for i in filtered if not voidLog1.match(i)]
    filtered = [i for i in filtered if not voidLog2.match(i)]
    filtered = [i for i in filtered if not voidLog3.match(i)]
    filtered = [i for i in filtered if not voidLog4.match(i)]
    filtered = [i for i in filtered if not voidLog5.match(i)]
    filtered = [i for i in filtered if not voidLog6.match(i)]
    filtered = [i for i in filtered if not voidLog7.match(i)]
    filtered = [i for i in filtered if not voidLog8.match(i)]
    return filtered

#inserts a tab at the start of log to when inserted into table the lodID is add>
def add_to_beginning(s, tab="\t"):
    return tab + s
#clear log file after it has been inserted into the database
def clearLogs():
    os.system("truncate -s 0 /var/log/remotelogs/systemserver/command-logging.log")
    os.system("truncate -s 0 /var/log/remotelogs/webserver/command-logging.log")

if __name__ == '__main__':
    secondlist = read_web_logfile()
    newlist = read_logfile()
    newlist = newlist + secondlist
    snoopyID = re.compile("\[[0-9]+\]: admin")
    newlist = [re.sub(snoopyID, "admin", i) for i in newlist]
    snoopyID_root = re.compile("\[[0-9]+\]: root")
    newlist = [re.sub(snoopyID_root, "root", i) for i in newlist]
    newlist = formatLogs(newlist)
    filtered = remove_log(newlist)
    filtered = list(map(add_to_beginning, filtered))
    write_formatted_logs(filtered)
    connect()
    clearLogs()