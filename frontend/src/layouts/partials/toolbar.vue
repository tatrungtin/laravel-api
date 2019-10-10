<template>
    <div class="app-toolbar">
        <div class="app-toolbar-left">
            <nav>
                <ol class="breadcrumb">
                    <!-- <li v-for="(item , index) in breadcrumb" :key="`index_${index}`" class="breadcrumb-item">
                        <router-link  v-if="item.route" :to="{ name : item.route}">
                            {{ item.name }}
                        </router-link>
                        <span v-else >
                            {{ item.name }}
                        </span>
                    </li> -->
                </ol>
            </nav>
        </div>
        <div class="app-toolbar-right">
            <div class="user">
                <div class="btn-group user-dropdown">
                    <span class="user-dropdown-btn" data-toggle="dropdown" data-display="static">
                        <div class="icon-label">VP</div>
                    </span>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" @click="userInfo">User Info</a>
                        <a class="dropdown-item" @click="changePassword">Change password</a>
                        <a class="dropdown-item" @click="logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <modal-change-password v-model="modal_change_password"></modal-change-password>
        <modal-user-info v-model="modal_user_info"></modal-user-info>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import ModalChangePassword from './modal-change-password'
import ModalUserInfo from './modal-user-info'
export default {
    name : 'Toolbar',
    components:{
        ModalChangePassword,
        ModalUserInfo
    },
    data(){
        return {
            modal_change_password : false,
            modal_user_info : false,
        }
    },
    computed:{

    },
    methods:{
        ...mapActions({
            logout : 'LOGOUT'
        }),
        changePassword(){
            this.modal_change_password = true
        },
        userInfo(){
            this.modal_user_info = true
        }
    }
}
</script>
<style lang="scss" scoped>
    .app-toolbar{
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row;
        user-select: none;
        &-left,&-right{
            width: 50%;
            padding: 0 15px;
        }
        &-right{
            display: flex;
            flex-direction: row-reverse;
        }
        &-left{
            display: flex;
            align-items: center;
        }
        .breadcrumb{
            background: transparent;
            padding: 0;
            margin: 0;
            li{
                a{
                    color: $text;
                    font-weight: 600;
                    &:hover{
                        color:$primary;
                        text-decoration: none;
                    }
                }
                span{
                    color:$text;
                    opacity: 0.6;
                }
            }
        }
        .user{
            padding: 5px 0;
            &-dropdown{
                &-btn{
                    height: 50px;
                    width: 50px;
                    border-radius: 50%;
                    background: #f2f2f2;
                    bottom: 1px solid #ccc;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    font-size: 16px;
                    text-transform: uppercase;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    &:hover{
                        background: #ddd;
                    }
                }
            }
            .dropdown-menu{
                a{
                    cursor: pointer;
                    display: block;
                    min-height: 34px;
                    display: flex;
                    align-items: center;
                    background: #fff;
                    color:$text;
                    &:hover{
                        background: #ddd;
                    }
                }
            }
        }
    }
</style>
