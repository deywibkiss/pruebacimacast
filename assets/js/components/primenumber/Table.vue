<template>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
			  <div class="panel-body">
			  	<div class="row">
			  		<div class="col-xs-4">
			  			<form class="form-inline">
			  				<div class="form-group">
			  					<label for="size">Tamaño:</label>
			  					<input type="number" name="size" class="form-control input-sm" v-model="size"/>
			  				</div>

			  				<button type="button" class="btn btn-primary" v-on:click="getTable">Generar</button>
			  			</form>
			  		</div>
			  	</div>
			  </div>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12">
							<table class="table cima-table">
								<tr v-for="row in table">
									<td 
									v-for="cell in row" 
									v-bind:class="cell.class" 
									v-on:click="showImage(cell.number)"
									>
										{{ cell.number }}
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Imagen</h4>
		      </div>
		      <div class="modal-body">
		        <img v-if="image" :src="image" class="number-image"/>
		        <p v-if="! image">No se ha encontrado la imagen para el número seleccionado</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</template>

<script>
    export default {
        mounted() {
        },

        components: {
		},
         
		data() {
			return {
				size: 1,
				numbers: [],
				table: [],
				image: false
			}
		},

		methods: {

			getTable: function(){

				var i;
				var j;
				var n = 0;

				this.numbers = this.generateNumbers();
				this.table = new Array(this.size);

				for (i = 0; i < this.size; i++) {

					this.table[i] = new Array(this.size);

					for (j = 0; j < this.size; j++) {
						this.table[i][j] = { number: this.numbers[n], class: 'colored' };

						if(n % 2 == 0)
							this.table[i][j].class = 'white';

						n++;
					}
				}

				console.log(this.table);

			},

			generateNumbers: function(){
				if(this.size <= 0)
					return;

				let cells = this.size * this.size;

				return this.getPrimes(cells);
			},

			isPrime: function(number){
				var start = 2;
			    while (start <= Math.sqrt(number)) {
			        if (number % start++ < 1)
			        	return false;
			    }

			    return number > 1;
			},

			getPrimes: function(n){
				const arr = [];
				let i = 2

				while (arr.length < n) {
					if (this.isPrime(i))
						arr.push(i);
					i++;
				}

				return arr;
			},

			showImage: function(n){

				if(n < 2)
					return;


				// Get Image
				axios.get('/prime-number/image/' + n).then((response) => {
					console.log(response.data);
					if(response.data.exists){
						this.image = response.data.url;
					} else {
						this.image = false;
					}

					$('#myModal').modal('toggle');
				});
			}
		}
    }
</script>