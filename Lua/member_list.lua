--
-- Created by IntelliJ IDEA.
-- User: luojunyuan
-- Date: 18-4-21
-- Time: 下午8:20
-- To change this template use File | Settings | File Templates.
--

local room_id = KEYS[1]

local member_list=redis.call('SMEMBERS','sweet:trolley:room:mermber:'..room_id..':set')
return member_list
