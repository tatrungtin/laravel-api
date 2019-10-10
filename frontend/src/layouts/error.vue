<template>
    <div class="error-layout">
		<transition name="fade" mode="out-in">
			<router-view />
		</transition>
	</div>
</template>
<style lang="scss" scoped>
	.error-layout{
		min-height: 100vh;
		padding: 50px 0;
		width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
		background: $primary;
		user-select: none;
	}
</style>