<template>
	<div  class="app-layout"  >
		<div class="app-layout-sidebar">
			<sidebar></sidebar>
		</div>
		<div class="app-layout-content">
			<div class="app-layout-toolbar">
				<toolbar></toolbar>
			</div>
			<div class="app-layout-content-wrapper">
				<transition name="fade" mode="out-in">
					<router-view />
				</transition>
			</div>
			<div class="app-layout-footer">

			</div>
		</div>
	</div>
</template>
<script>
import sidebar from './partials/sidebar'
import toolbar from './partials/toolbar'
import { mapActions, mapGetters } from 'vuex';
export default {
	name : 'AdminLayout',
	components: {
		sidebar , toolbar
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
		background: $primary;
	}
	.app-layout{
		width: 100%;
		height: 100vh;
		position: relative;
		background: #f2f2f2;
		min-width: 1360px;
		overflow: hidden;
		&-sidebar{
			position: fixed;
			width: 300px;
			z-index: 1001;
			top: 0;
			left: 0;
			bottom: 0;
			background: $primary;
		}
		&-content{
			width: 100%;
			padding-left: 300px;
			position: relative;
			height: 100%;
			overflow: auto;
			&-wrapper{
				width: 1170px;
				display: block;
				margin-left: auto;
				margin-right: auto;
				padding: 30px 15px;
			}
		}
		&-toolbar{
			display: block;
			width: 100%;
			height: 60px;
			position: sticky;
			top: 0;
			left: 0;
			right: 0;
			z-index: 1000;
			background: #fff;
			box-shadow: 0 3px 1px -2px rgba(0,0,0,.2), 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 3px 0 rgba(0,0,0,.12);
		}
	}
	 @media(max-width:1600px){
        .app-layout{
			&-sidebar{
				width: 68px;
			}
			&-content{
				padding-left: 68px;
			}
		}
    }
</style>
