--
-- Created by IntelliJ IDEA.
-- User: luojunyuan
-- Date: 18-4-21
-- Time: 上午10:17
-- To change this template use File | Settings | File Templates.
--
--$userId, $invite_user
local userId=KEYS[1]
local invite_user=KEYS[2]

local room_id = redis.call('hget','sweet:trolley:list:hashmap',userId)
if (room_id=='nil') then
    return false
end

local result= redis.call('hset','sweet:trolley:list:hashmap',invite_user,room_id)
if (result)then
    return true
else
    return false
end




