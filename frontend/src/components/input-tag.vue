<template>
    <div class="input-tags">
        <vue-input-tag :class="{ 'is-max' : tag.length == maxTags}" v-model="input"  :tags="tag" :add-on-key="addOnKey" :avoid-adding-duplicates="!duplicate"  @tags-changed="onChangeTags" :disabled="disabled" :placeholder="placeholder" :max-tags="maxTags"></vue-input-tag>
    </div>
</template>
<script>
import VueInputTag from '@johmun/vue-tags-input';
export default {
    name : 'Tags',
    components:{
        VueInputTag
    },
    props:{
        value :{
            type : Array,
        },
        placeholder:{
            type :String,
            default : 'Add tag'
        },
        maxTags:{
            default : 10,
        },
        addOnKey :{
            type : Array,
            default : [13,188]
        },
        duplicate :{
            type : Boolean,
            default : true
        },
        disabled :{
            type : Boolean,
            default : false
        }
    },
    data(){
        return {
            input : '',
        }
    },
    computed:{
        tag : {
            get(){
                return this.value.map((item)=>{
                    return {
                        text: item,
                    }
                })
            },
            set(value){
                this.$emit('input', value)
            }
        }
    },
    methods:{
        onChangeTags(tags){
            this.tag = tags.map((item)=>{
                return item.text
            })
        }
    }
}
</script>