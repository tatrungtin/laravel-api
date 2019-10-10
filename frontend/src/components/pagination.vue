<template>
    <ul :class="containerClass" v-if="total > 1">
        <template v-if="routerLink">
            <li v-if="firstLastButton" :class="[pageClass, firstPageSelected() ? disabledClass : '']">
                <router-link @click="selectFirstPage()" @keyup.enter="selectFirstPage()" :class="pageLinkClass" :tabindex="firstPageSelected() ? -1 : 0"
                    v-html="firstButtonText" :to="setRouterLink(1)"></router-link>
            </li>

            <li v-if="!(firstPageSelected() && hidePrevNext)" :class="[prevClass, firstPageSelected() ? disabledClass : '']">
                <router-link :to="setRouterLink(selected - 1)" @click="prevPage()" @keyup.enter="prevPage()" :class="prevLinkClass" :tabindex="firstPageSelected() ? -1 : 0"
                    v-html="prevText"></router-link>
            </li>

            <li v-for="(page, index) in pages" :class="[pageClass, page.selected ? activeClass : '', page.disabled ? disabledClass : '', page.breakView ? breakViewClass: '']" :key="`page_index_${index}`">
                <a v-if="page.breakView" :class="[pageLinkClass, breakViewLinkClass]" tabindex="0">
                    <slot name="breakViewContent">{{ breakViewText }}</slot>
                </a>
                <a v-else-if="page.disabled" :class="pageLinkClass" tabindex="0">{{ page.content }}</a>
                <router-link v-else @click="handlePageSelected(page.index + 1)" 
                @keyup.enter="handlePageSelected(page.index + 1)"
                :class="pageLinkClass" :to="setRouterLink(page.index + 1)"
                    tabindex="0">{{ page.content }}</router-link>
            </li>

            <li v-if="!(lastPageSelected() && hidePrevNext)" :class="[nextClass, lastPageSelected() ? disabledClass : '']">
                <router-link :to="setRouterLink(selected + 1)" @click="nextPage()" @keyup.enter="nextPage()" :class="nextLinkClass" :tabindex="lastPageSelected() ? -1 : 0"
                    v-html="nextText"></router-link>
            </li>

            <li v-if="firstLastButton" :class="[pageClass, lastPageSelected() ? disabledClass : '']">
                <router-link :to="setRouterLink(total)"  @click="selectLastPage()" @keyup.enter="selectLastPage()" :class="pageLinkClass" :tabindex="lastPageSelected() ? -1 : 0"
                    v-html="lastButtonText"></router-link>
            </li>
        </template>
        <template v-else>
            <li v-if="firstLastButton" :class="[pageClass, firstPageSelected() ? disabledClass : '']">
                <a @click="selectFirstPage()" @keyup.enter="selectFirstPage()" :class="pageLinkClass" :tabindex="firstPageSelected() ? -1 : 0"
                    v-html="firstButtonText" ></a>
            </li>

            <li v-if="!(firstPageSelected() && hidePrevNext)" :class="[prevClass, firstPageSelected() ? disabledClass : '']">
                <a  @click="prevPage()" @keyup.enter="prevPage()" :class="prevLinkClass" :tabindex="firstPageSelected() ? -1 : 0"
                    v-html="prevText"></a>
            </li>

            <li v-for="(page, index) in pages" :class="[pageClass, page.selected ? activeClass : '', page.disabled ? disabledClass : '', page.breakView ? breakViewClass: '']" :key="`page_index_${index}`">
                <a v-if="page.breakView" :class="[pageLinkClass, breakViewLinkClass]" tabindex="0">
                    <slot name="breakViewContent">{{ breakViewText }}</slot>
                </a>
                <a v-else-if="page.disabled" :class="pageLinkClass" tabindex="0">{{ page.content }}</a>
                <a v-else @click="handlePageSelected(page.index + 1)" 
                @keyup.enter="handlePageSelected(page.index + 1)"
                :class="pageLinkClass" 
                    tabindex="0">{{ page.content }}</a>
            </li>

            <li v-if="!(lastPageSelected() && hidePrevNext)" :class="[nextClass, lastPageSelected() ? disabledClass : '']">
                <a  @click="nextPage()" @keyup.enter="nextPage()" :class="nextLinkClass" :tabindex="lastPageSelected() ? -1 : 0"
                    v-html="nextText"></a>
            </li>

            <li v-if="firstLastButton" :class="[pageClass, lastPageSelected() ? disabledClass : '']">
                <a   @click="selectLastPage()" @keyup.enter="selectLastPage()" :class="pageLinkClass" :tabindex="lastPageSelected() ? -1 : 0"
                    v-html="lastButtonText"></a>
            </li>
        </template>
    </ul>
</template>

<script>
export default {
    props: {
        value: {
            type: [Number , String]
        },
        total: {
            type: Number,
            required: true
        },
        routerLink :{
            default : true,
        },
        forcePage: {
            type: Number
        },
        change: {
            type: Function,
            default: () => {}
        },
        pageRange: {
            type: Number,
            default: 5
        },
        marginPages: {
            type: Number,
            default: 1
        },
        prevText: {
            type: String,
            default: '<i class="material-icons" title="Previous Page">chevron_left</i>'
        },
        nextText: {
            type: String,
            default: '<i class="material-icons" title="Next Page">chevron_right</i>'
        },
        breakViewText: {
            type: String,
            default: '…'
        },
        containerClass: {
            type: String,
            default : 'pagination'
        },
        pageClass: {
            type: String
        },
        pageLinkClass: {
            type: String
        },
        prevClass: {
            type: String
        },
        prevLinkClass: {
            type: String
        },
        nextClass: {
            type: String
        },
        nextLinkClass: {
            type: String
        },
        breakViewClass: {
            type: String
        },
        breakViewLinkClass: {
            type: String
        },
        activeClass: {
            type: String,
            default: 'active'
        },
        disabledClass: {
            type: String,
            default: 'disabled'
        },
        noLiSurround: {
            type: Boolean,
            default: false
        },
        firstLastButton: {
            type: Boolean,
            default: true
        },
        firstButtonText: {
            type: String,
            default: '<i class="material-icons" title="First Page">first_page</i>'
        },
        lastButtonText: {
            type: String,
            default: '<i class="material-icons" title="Last Page">last_page</i>'
        },
        hidePrevNext: {
            type: Boolean,
            default: false
        }
    },
    beforeUpdate() {
        if (this.forcePage === undefined) return
        if (this.forcePage !== this.selected) {
            this.selected = this.forcePage
        }
    },
    computed: {
        selected: {
            get: function () {
                return parseInt(this.value) || this.innerValue
            },
            set: function (newValue) {
                this.innerValue = newValue
            }
        },
        pages: function () {
            let items = {}
            if (this.total <= this.pageRange) {
                for (let index = 0; index < this.total; index++) {
                    let page = {
                        index: index,
                        content: index + 1,
                        selected: index === (this.selected - 1)
                    }
                    items[index] = page
                }
            } else {
                const halfPageRange = Math.floor(this.pageRange / 2)

                let setPageItem = index => {
                    let page = {
                        index: index,
                        content: index + 1,
                        selected: index === (this.selected - 1)
                    }

                    items[index] = page
                }

                let setBreakView = index => {
                    let breakView = {
                        disabled: true,
                        breakView: true
                    }

                    items[index] = breakView
                }

                for (let i = 0; i < this.marginPages; i++) {
                    setPageItem(i);
                }

                let selectedRangeLow = 0;
                if (this.selected - halfPageRange > 0) {
                    selectedRangeLow = this.selected - 1 - halfPageRange;
                }

                let selectedRangeHigh = selectedRangeLow + this.pageRange - 1;
                if (selectedRangeHigh >= this.total) {
                    selectedRangeHigh = this.total - 1;
                    selectedRangeLow = selectedRangeHigh - this.pageRange + 1;
                }

                for (let i = selectedRangeLow; i <= selectedRangeHigh && i <= this.total - 1; i++) {
                    setPageItem(i);
                }

                if (selectedRangeLow > this.marginPages) {
                    setBreakView(selectedRangeLow - 1)
                }

                if (selectedRangeHigh + 1 < this.total - this.marginPages) {
                    setBreakView(selectedRangeHigh + 1)
                }

                for (let i = this.total - 1; i >= this.total - this.marginPages; i--) {
                    setPageItem(i);
                }
            }
            return items
        }
    },
    data() {
        return {
            innerValue: 1,
        }
    },
    methods: {
        setRouterLink(page){
            var route = {
                name : this.$route.name,
                query : JSON.parse(JSON.stringify(this.$route.query)),
                params : JSON.parse(JSON.stringify(this.$route.params)),
            }
            route.query['page'] = page
            return this.setRouterLinkHandler(route)
        },
        setRouterLinkHandler( { name  , params , query } ){
            let current = {
                name : this.$route.name,
                params : this.$route.params,
                query : this.$route.query
            }
            if( name ){
                current.name = name
            }
            if( params ){
                current.params = params
            }
            if( query ){
                current.query = query
            }
            return current
        },
        handlePageSelected(selected) {
            if (this.selected === selected) return

            this.innerValue = selected
            this.$emit('input', selected)
            this.change(selected)
        },
        prevPage() {
            if (this.selected <= 1) return

            this.handlePageSelected(this.selected - 1)
        },
        nextPage() {
            if (this.selected >= this.total) return

            this.handlePageSelected(this.selected + 1)
        },
        firstPageSelected() {
            return this.selected === 1
        },
        lastPageSelected() {
            return (this.selected === this.total) || (this.total === 0)
        },
        selectFirstPage() {
            if (this.selected <= 1) return

            this.handlePageSelected(1)
        },
        selectLastPage() {
            if (this.selected >= this.total) return

            this.handlePageSelected(this.total)
        }
    }
}
</script>

<style lang="scss" scoped>
    .pagination{
        display: flex;
        justify-content: center;
        flex-direction: row;
        flex-wrap: nowrap;
        li{
            display: inline-flex;
            padding: 0 3px;
            a{
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 36px;
                min-width: 36px;
                padding: 0;
                text-decoration: none;
                color:$text;
                border: 1px solid #ddd;
                font-size: 14px;
                font-weight: 500;
                background: #fff;
                user-select: none;
                border-radius: 5px;
                transition: all 0.2s ease;
                cursor: pointer;
                &:hover{
                    background: $primary;
                    color:#fff;
                    border-color:$primary;
                }
            }
            &.disabled{
                opacity: 0.7;
                cursor: not-allowed;
                a{
                    pointer-events: none;
                    &:hover{
                        background: #fff;
                        color:#fff;
                    }
                }
            }
            &.active{
                a{
                    background: $primary;
                    color:#fff;
                }
            }
        }
    }
</style>
