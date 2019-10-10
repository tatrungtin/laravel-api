<template>
	<div id="app">
		<transition name="fade" mode="out-in">
			<div v-if="is_loading" key="is-loading" class="app-loading">
				<div class="icon-loading large"></div>
			</div>
			<div v-else key="is-loading-success">
				<vue-extend-layouts />
			</div>
		</transition>
	</div>
</template>

<script>
	import VueExtendLayouts from 'vue-extend-layout'
	import { mapActions, mapGetters } from 'vuex';
	export default {
		name: 'App',
		components: {
			VueExtendLayouts
		},
		computed: {
			...mapGetters({
				is_loading : 'getLoading'
			})
		},
	}
</script>
<style lang="scss" scoped>
	.app-loading{
		height: 100vh;
		width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
		background: $purple;
	}
</style>
