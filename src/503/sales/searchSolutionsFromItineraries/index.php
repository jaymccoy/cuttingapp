<?php

#PAO broken
#sleep(2);
#http_response_code(503);
#echo "Service Unavailable";

#PAO ok, but empty response
http_response_code(200);
echo "{}";

?>
