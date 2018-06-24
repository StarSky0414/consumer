--
-- Created by IntelliJ IDEA.
-- User: luojunyuan
-- Date: 18-4-21
-- Time: 上午10:47
-- To change this template use File | Settings | File Templates.
--fiction_name trolley_user_exit_list

local user_id=KEYS[1]
local room_id=redis.call('hget','sweet:trolley:list:hashmap',user_id)
if(room_id=='nil')then
    return false
else
    return room_id
end



