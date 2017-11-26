<template>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
			  <div class="panel-body">
			  	<div class="row">
			  		<div class="col-xs-12">
			  			<a v-bind:href="createroute" class="btn btn-primary pull-right">Crear producto</a>
			  		</div>
			  	</div>
			  </div>
			</div>
		</div>
		
		<div class="col-xs-12">
			<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Lista de Productos</h3>
			  	</div>
			  	<div class="panel-body">
			  		<table class="table table-hover table-striped">
				  		<thead>
				  			<tr>
				  				<th>Nombre</th>
				  				<th>Slug</th>
				  				<th>Precio</th>
				  				<th>Categoría</th>
				  				<th colspan="2">Acciones</th>
				  			</tr>
				  		</thead>

				  		<tbody>
				  			<tr v-for="product in products">
				  				<td>{{ product.name }}</td>

				  				<td>{{ product.slug }}</td>

				  				<td>{{ product.price }}</td>

				  				<td>
				  					{{ product.category.name }}
				  				</td>
				  				
				  				<td width="50px">
				  					<a :href="'/product/' + product.id + '/edit'" class="btn btn-default btn-sm" aria-label="editar">
				  						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				  					</a>
				  				</td>
				  				<td width="50px">
				  					<button type="button" class="btn btn-danger btn-sm" aria-label="eliminar" v-on:click="deleteProduct(product)">
				  						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				  					</button>
				  				</td>
				  			</tr>
				  		</tbody>
			  		</table>
			  	</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        mounted() {
        	this.getProducts();
        },

        components: {
		},

		props: ['createroute'],
         
		data() {
			return {
				term: '',
				laravelData: {},
				products: [],
				showLoader: false,
				label: 'Obteniendo lista de productos...'
			}
		},

		methods: {

			getProducts: function(){
				// Requests will be executed in parallel...
				axios.get('/product/all').then((response) => {
					console.log(response);
					this.products = JSON.parse(response.data.products);
					console.log(this.products);
				});
			},


			deleteProduct: function(product){
				axios.delete('/product/deleteAjax/' + product.id).then(response => {
		    		this.getProducts();
		    	}).catch(error => {
	    			console.error(error);
		    	});
			}
		}
    }
</script>