import redis
r = redis.Redis(host='127.0.0.1', port=6379,db=0) 
for a in range(0,10000):
    r.sadd('sweet:indent:pool:set',a)
print "it is ok!"
