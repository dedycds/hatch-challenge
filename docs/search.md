# **SearchController**

---

## **GET /search** ##
Searching for places
### Resource URL
GET http://example.com/api/search?s=xxx&key=xxxx
### Parameters
1. URI Parameters: -
2. Query String Parameters: 
	* s (optional): search term including location
	* key (required): secret value used to authenticate request
3. Body Content Parameters: -
### Precondition
 -
### Examples Request
GET http://example.com/api/search?s=pizza, Los Angeles&key=xxxx