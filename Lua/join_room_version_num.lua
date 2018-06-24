--
-- Created by IntelliJ IDEA.
-- User: luojunyuan
-- Date: 18-4-21
-- Time: 下午1:10
-- To change this template use File | Settings | File Templates.
--

local room_id=KEYS[1]
local version_num=redis.call('lindex','sweet:trolley:item:list:'..room_id..':list','0')
return version_num;
