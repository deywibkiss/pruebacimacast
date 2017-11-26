<template>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
			  <div class="panel-body">
			  	<div class="row">
			  		<div class="col-xs-12">
			  			<a v-bind:href="createroute" class="btn btn-primary pull-right">Crear categoría</a>
			  		</div>
			  	</div>
			  </div>
			</div>
		</div>
		
		<div class="col-xs-12">
			<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Lista de Categorías</h3>
			  	</div>
			  	<div class="panel-body">
			  		<table class="table table-hover table-striped">
				  		<thead>
				  			<tr>
				  				<th>Id</th>
				  				<th>Nombre</th>
				  				<th colspan="2">Acciones</th>
				  			</tr>
				  		</thead>

				  		<tbody>
				  			<tr v-for="category in categories">
				  				<td>{{ category.id }}</td>

				  				<td>{{ category.name }}</td>
				  				
				  				<td width="50px">
				  					<a :href="'/category/' + category.id + '/edit'" class="btn btn-default btn-sm" aria-label="editar">
				  						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				  					</a>
				  				</td>
				  				<td width="50px">
				  					<button type="button" class="btn btn-danger btn-sm" aria-label="eliminar" v-on:click="deleteCategory(category)">
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
        	this.getCategories();
        },

        components: {
		},

		props: ['createroute'],
         
		data() {
			return {
				term: '',
				laravelData: {},
				categories: [],
				showLoader: false,
				label: 'Obteniendo lista de categorías...'
			}
		},

		methods: {

			getCategories: function(){
				// Requests will be executed in parallel...
				axios.get('/category/all').then((response) => {
					console.log(response);
					this.categories = JSON.parse(response.data.categories);
				});
			},


			deleteCategory: function(category){
				axios.delete('/category/deleteAjax/' + category.id).then(response => {
		    		this.getCategories();
		    	}).catch(error => {
	    			console.error(error);
		    	});
			}
		}
    }
</script>