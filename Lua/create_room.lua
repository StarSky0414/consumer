--
-- Created by IntelliJ IDEA.
-- User: luojunyuan
-- Date: 18-4-21
-- Time: 上午9:25
-- To change this template use File | Settings | File Templates.
--

--
local room_id=KEYS[1]
local house_owner=KEYS[2]
local mer_id=KEYS[3]
local timestamp=KEYS[4]
redis.call('hset','sweet:trolley:room:info:'..room_id..':hashmap','house_owner',house_owner)
redis.call('hset','sweet:trolley:room:info:'..room_id..':hashmap','timestamp',timestamp)
redis.call('hset','sweet:trolley:room:info:'..room_id..':hashmap','mer_id',mer_id)
--
redis.call('hset','sweet:trolley:list:hashmap',house_owner,room_id)
--
redis.call('rpush','sweet:trolley:item:list:'..room_id..':list',1)


return true