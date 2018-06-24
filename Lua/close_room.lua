--
-- Created by IntelliJ IDEA.
-- User: luojunyuan
-- Date: 18-4-22
-- Time: 下午5:57
-- To change this template use File | Settings | File Templates.
--

local room_id = KEYS[1]
local user_list=redis.call('SMEMBERS','sweet:trolley:room:mermber:'..room_id..':set')

for k,v in ipairs(user_list) do
    redis.call('hdel','sweet:trolley:list:hashmap',v)
end
redis.call('del','sweet:trolley:room:mermber:'..room_id..':set')
redis.call('del','sweet:trolley:room:info:'..room_id..':hashmap')
redis.call('del','sweet:trolley:item:list:'..room_id..':list')
return true


