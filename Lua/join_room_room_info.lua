--
-- Created by IntelliJ IDEA.
-- User: luojunyuan
-- Date: 18-4-21
-- Time: 上午11:10
-- To change this template use File | Settings | File Templates.
--
local room_id = KEYS[1]
local user_id = KEYS[2]
redis.call('sadd','sweet:trolley:room:mermber:'..room_id..':set',user_id)
local room_info=redis.call('hgetall','sweet:trolley:room:info:'..room_id..':hashmap')
return room_info

