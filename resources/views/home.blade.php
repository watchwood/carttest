<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shopping Cart Test</title>

        <link href="main.css" rel="stylesheet" />
		<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

       
    </head>
    <body>
		<header>
			<nav>Nav Menu Placeholder</nav>
		</header>

		<!--  I would typically build the Vue code as a separate .vue file, but the complexity isn't needed for this project -->

		<main id="app">
        	<h1>Shopping Cart Test</h1>
			<table class="cart">
				<tr v-for="item in items" :key="item.id">
					<td>
						<div class="cartItem">@{{item.item.name}}</div>
						<div class="cartPrice"><b>@{{item.item.price}}</b></div>
					</td>
					<td class="cartAmount">
						<button @click="subItem(item)">-</button>
						<input @change="updateItem(item)" type="text" v-model="item.amount">
						<button @click="addItem(item)">+</button>
					</td>
				</tr>
			</table>

			<section class="checkout">
				<div>Subtotal: $<b>@{{subtotal}}</b></div>
				<div>QST (9.975%): $<b>@{{qst}}</b></div>
				<div>GST (5%): $<b>@{{gst}}</b></div>
				<div>Total: $<b>@{{total}}</b></div>
				<button>Checkout</button>
			</section>
		</main>

    </body>

	<script>
		const { createApp, ref } = Vue
		const userId = "{{$userId}}";  //This is outside the Vue data bindings because it is not needed by the Vue template
		createApp({
			data() {
				return {
					items: JSON.parse('{!!json_encode($items)!!}'),
				}
			},
			computed: {
				//Fun fact:  Vue will cache these values and only update as needed
				//Everything gets rounded because floating point errors
				subtotal(){
					var sum = 0;
					for (item of this.items){
						sum += item.amount * item.item.price;
					}
					return Math.round(sum * 100) / 100;
				},
				qst(){
					return Math.round(this.subtotal * 9.975) / 100;
				},
				gst(){
					return Math.round(this.subtotal * 5) / 100;
				},
				total(){
					return sum = Math.round((this.subtotal + this.qst + this.gst) * 100) / 100;
				},
			},
			methods: {
				addItem(item) {
					item.amount++;
					this.itemCall(item);
				},
				subItem(item) {
					item.amount--;
					this.itemCall(item);
				},
				updateItem(item) {
					this.itemCall(item);
				},
				async itemCall(item) {
					try {
						const {data} = await axios.get('/api/setItem?userId='+userId+'&id='+item.id+'&amount='+item.amount);
						this.items = data;
					}
					catch (e){
						console.log(e);
					}
				}
			},
		}).mount('#app')
	  </script>
</html>
