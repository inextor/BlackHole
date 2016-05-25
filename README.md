##Get the indes for a keyword

```javascript
ajax({
	method		: 'post'
	data		: {keyword: 'keyword' }
	dataType	: 'json'
	success		: function( response )
	{
		if( !response.result )
		{
			alert( response.msg );
			return;
		}

		console.log('Ids are',response.data );
	}
});
```

##Retrive the content for the a id

```javascript
ajax
({
	method		: 'post'
	data		: { id: 10234 }
	dataType	: 'json'
	success		: function( response )
	{
		if( !response.result )
		{
			alert( response.msg );
			return;
		}

		console.log('Ids are',response.data );
	}
});
```

##Add a Record

```javascript
ajax
({
	method		: 'post'
	data		: { keyword : 10234, data : 'whatever data has in' }
	dataType	: 'json'
	success		: function( response )
	{
		if( !response.result )
		{
			alert( response.msg );
			return;
		}

		console.log('Ids are',response.data );
	}
});
```

