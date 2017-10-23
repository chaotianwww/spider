#!/usr/bin/python
# -*- coding: UTF-8 -*-

'''
max = raw_input("Enter a number  :");
i = 1;
while i <= int(max):
    x = "";
    j = 1;
    while j <= i:
        x += str(j)+"*"+str(i)+"="+str(j*i)+" ";
        j+=1;
    i+=1;
    print x;

'''

'''
num = raw_input("input num");
num = int(num)
if num >100:
    print ">100"
elif num > 50:
    print ">50"
elif num >10:
    print ">10"
'''

'''
i = ['a', 'b']
l = [1, 2]
print dict([i,l])
'''

'''
if __name__ == '__main__':
    import string
    fp = open("tmp")
    a = fp.read()
    fp.close()

    fp2 = open("tmp2","w")
    fp2.write(a)
    fp2.close()
    print "over"
'''

'''
text = raw_input("please input some text ... :")
fp2 = open("tmp2","w")
old_text = fp2.read()
fp2.write(old_text+"\n"+text)
fp2.close()
'''



import urllib
import urllib2
import re

page =  1
url = 'http://www.qiushibaike.com/hot/page/' + str(page)
user_agent = 'Mozilla/4.0 (compatible; MSIE 5.5; Windows NT)'
headers = { 'User-Agent' : user_agent }
try:
	request = urllib2.Request(url,headers = headers)
	response = urllib2.urlopen(request)
	tmpText = response.read()
	
	fp2 = open("tmp","w")
	
	pattern = re.compile('<div.*?author">.*?<a.*?<img.*?>(.*?)</a>.*?<div.*?'+
							'content">(.*?)<!--(.*?)-->.*?</div>(.*?)<div class="stats.*?class="number">(.*?)</i>',re.S)
	
	items = re.findall(pattern,tmpText)
	fp2.write('action\n')
	fp2.write(tmpText)
	
	
	for item in items:
		fp2.write(item[0]+'--'+item[1]+'---'+item[2]+'---'+item[3]+'---'+item[4])
	fp2.write('\nok')
	print 'ok'
except urllib2.URLError,e:
	if hasattr(e,'code'):
		print e.code
	if hasattr(e,'resaon'):
		print e.reason