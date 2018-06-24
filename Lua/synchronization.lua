--
-- Created by IntelliJ IDEA.
-- User: luojunyuan
-- Date: 18-4-21
-- Time: 下午1:51
-- To change this template use File | Settings | File Templates.
--


local room_id=KEYS[1]
local start=KEYS[2]
local stop=KEYS[3]
local item_list=redis.call('lrange','sweet:trolley:item:list:'..room_id..':list',start,stop)
return item_list

