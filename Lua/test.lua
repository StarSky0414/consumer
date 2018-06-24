--local aaa = redis.call("hget","sweet:trolley:lua_function_SHA:hashmap","test")
redis.call('hset','sweet:trolley:lua_function_SHA:hashmap','test1','123')
local b=redis.pcall('hset','sweet:trolley:lua_function_SHA:hashmap2','t','cccc')
return b