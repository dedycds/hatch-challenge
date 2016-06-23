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
        	<h1>Search Location</h1>
           	
           	<div id="search-container">
           	</div>
           	<script>
           		var serverValues = {
           			api_key : '<% Config::get('api.key') %>'
           		}; 
           	</script>
			<script type="text/babel">
				var Search = React.createClass({
					getInitialState: function () {
					  return { data : [], loading: false};
					},
					onInputChange: function (event) {
						this._callSearch(event.target.value)
					},
					_callSearch : function(term) {
						console.log('call search');
						this.setState({data : [], loading : true});
						
						if(this.serverRequest)
							this.serverRequest.abort();
						
						this.serverRequest = $.get('/api/search', {s : term, key : serverValues.api_key }, function(data) {
							var data = data.searchResult.searchListings.searchListing;
							this.setState({data : data, loading : false});
							
						}.bind(this))
						.fail(function(response) {
							if(response.status === 400)
								this.setState({data : null, loading : false});
						}.bind(this));			
					},
					render: function () {
					  return (
					  	<div className="form-group">	
					   		<input className="form-control" type="text" placeholder="Pizza, Los Angeles" onChange={this.onInputChange}/>
					   		<List items={this.state.data} loadingState={this.state.loading}/>
					   	</div>
					  );
					}
				});

				var List = React.createClass({
					getInitialState : function () {
						return {};
					},

					showDetail: function (id) {
						window.location.href = '/place/' + id;
					},

					render : function () {
						var items = this.props.items;
						var data = '';
						
						if(this.props.loadingState){
							data = <li className="list-group-item" >Loading...</li>
						} else {
							if(this.props.items === null) {
					  			data = <li className="list-group-item" >No location found.</li>
					  		} else {
					  			data = items.map(function(item){
					      			return <li className="list-group-item" onClick={()=>this.showDetail(item.listingId)}><a href="javaScript:;">{item.businessName}</a></li>
					      		}.bind(this));
					  		}
						}

						return (
							<ul className="list-group">
								{data}
							</ul>
						);
					}

				});
				ReactDOM.render(
					<Search />,
					document.getElementById('search-container')
				);
		    </script>
       </div>
    </div>
@stop
