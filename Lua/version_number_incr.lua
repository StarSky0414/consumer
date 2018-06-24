--
-- Created by IntelliJ IDEA.
-- User: luojunyuan
-- Date: 18-4-21
-- Time: 下午2:57
-- To change this template use File | Settings | File Templates.
--

local room_id=KEYS[1]
local nickname=KEYS[2]
local item_id=KEYS[3]
local operate=KEYS[4]
local old_version=redis.call('lindex','sweet:trolley:item:list:'..room_id..':list',0)
local new_version=(old_version+1)

redis.call('lset','sweet:trolley:item:list:'..room_id..':list',new_version)
redis.call('rpush','sweet:trolley:item:list:'..room_id..':list',operate,item_id,nickname)

return true


