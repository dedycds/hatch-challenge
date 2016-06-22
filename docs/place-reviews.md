# **PlaceReviewController**

---

## **GET /places/{id}/reviews** ##
Get all reviews of a places
### Resource URL
GET http://example.com/api/places/{id}/reviews?key=xxxx
### Parameters
1. URI Parameters: 
	* id (required): place id or listing id from YP
2. Query String Parameters: 
	* key (required): secret value used to authenticate request
3. Body Content Parameters: -
### Precondition
 -
### Examples Request
GET http://example.com/api/places/520282945/reviews?key=xxxx