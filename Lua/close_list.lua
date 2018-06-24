--
-- Created by IntelliJ IDEA.
-- User: luojunyuan
-- Date: 18-4-22
-- Time: 下午4:23
-- To change this template use File | Settings | File Templates.
--

local room_id=KEYS[1]
--local i =0
for k,v in ipairs(ARGV) do
--while (ARGV[i]~='nil') do
    local user_id = v
    if (redis.call('hget','sweet:trolley:list:hashmap',user_id)==room_id)then
        redis.call('HDEL','sweet:trolley:list:hashmap',user_id)
    end
    redis.call('srem','sweet:trolley:room:mermber:'..room_id..':set',user_id)
end
return true




