# **PlaceController**

---

## **GET /places/{id}** ##
Get place detail based on data from YP API
### Resource URL
GET http://example.com/api/places/{id}?key=xxxx
### Parameters
1. URI Parameters: 
	* id (required): place id or listing id from YP
2. Query String Parameters: 
	* key (required): secret value used to authenticate request
3. Body Content Parameters: -
### Precondition
 -
### Examples Request
GET http://example.com/api/places/520282945?key=xxxx