<template>
	<div class="auth-layout">
		<transition name="fade" mode="out-in">
			<router-view />
		</transition>
	</div>
</template>
<script>
export default {
	name : 'AuthLayout'
}
</script>
<style lang="scss" scoped>
	.auth-layout{
		min-height: 100vh;
		padding: 50px 0;
		width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
		background: $primary;
	}
</style>

