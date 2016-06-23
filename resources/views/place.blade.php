@extends('layout')
@section('header')
	@parent
	<script src="<% web_asset('js/react.min.js') %>"></script>
	<script src="<% web_asset('js/react-dom.min.js') %>"></script>
	<script src="<% web_asset('js/jquery-3.0.0.min.js') %>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>

@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
           	<div id="place-container">
           	</div>
           	<script>
           		var serverValues = {
           			api_key : '<% Config::get('api.key') %>',
           			placeId : <% $id %>
           		}; 
           	</script>

			<script type="text/babel">
				var Place = React.createClass({
					getInitialState: function () {
					  return {data : {}, loading : true};
					},
					componentDidMount: function() {
						var url = '/api/places/' + serverValues.placeId;
						this.serverRequest = $.get(url, {key : serverValues.api_key}, function (result) {
						 	var data = result.listingsDetailsResult.listingsDetails.listingDetail[0];
						 	this.setState({data : this.__formatData(data), loading: false});
						}.bind(this));
					},
					componentWillUnmount: function() {
						this.serverRequest.abort();
					},
					__formatData: function(data) {
					 	var d = {
					 		businessName : data.businessName ? data.businessName : "Place Not Found",
					 		description1 : data.description1 ? data.description1 : "-",
					 		website : data.extraWebsiteURLs.extraWebsiteURL ? data.extraWebsiteURLs.extraWebsiteURL[0] : "#",
					 		ratingCount : data.ratingCount,
					 		address : data.street ? data.street + (data.state ? " ," + data.state : "") : "-",
					 		openHours : data.openHours,
					 		phone : data.phone,
					 		ratingCount : data.ratingCount,
					 		services : data.services
					 	};
						return d;
					},
					render: function () {
						var place = this.state.data;
						return (
							<div>
							  	<h1>
							  		{this.state.loading ? "Please wait..." : place.businessName}
							  	</h1>
							  	<hr/>
							  	<h3>Detail</h3>
							  	<h5>Service: {!this.state.loading ? place.services : '-'}</h5>
							  	<h5>Description:</h5>
							  	<p>{place.description1 ? place.description1 : "-"}</p>

							  	<h5><a href={!this.state.loading ? place.website : '#'}>Website</a></h5>
							  	<h5>Rating : {!this.state.loading ? place.ratingCount : 0}</h5>
							  	
							  	<h3>Contact</h3>
							  	<h5>Phone: {!this.state.loading ? place.phone : "-"}</h5>
							  	<h5>Address: {!this.state.loading ? place.address : "-"} </h5>
							  	<h5>Open hours: {!this.state.loading ? place.openHours : "-"} </h5>

							  	<Reviews placeId={serverValues.placeId}/>
							</div>
						);
					}
				});

				var Reviews = React.createClass({
					getInitialState : function () {
						return {data : [], loading : true, count : 0};
					},
					componentDidMount: function() {
						var url = '/api/places/' + this.props.placeId + '/reviews';
						this.serverRequest = $.get(url, {key : serverValues.api_key}, function (result) {
						 	this.setState({
						 		data : result.ratingsAndReviewsResult.reviews.review, 
						 		loading : false,
						 		count : result.ratingsAndReviewsResult.metaProperties.totalReviews
						 	});
						}.bind(this));
					},
					componentWillUnmount: function() {
						this.serverRequest.abort();
					},
					render : function () {
						var loading = this.state.loading;
						var items = this.state.data || [];

						var content = items.map(function(item) {
							var date = new Date(item.reviewDate)
							return (
								<div> 
									<p>rating : {item.rating} | reviewer : {item.reviewer} | on : {date.toLocaleString()}</p> 
									<p><strong>Subject : {(item.subject || "-") }</strong></p>
									<p>{(item.reviewBody || "-")}</p>
									<hr/>
								</div>
							);
						});
						return (
							<div>
								<h3>Reviews ({loading ? "Loading reviews..." : this.state.count })</h3>
 								{content}
							</div>
						);
					}
				});

				ReactDOM.render(
					<Place />,
					document.getElementById('place-container')
				);
		    </script>
       </div>
    </div>
@stop
