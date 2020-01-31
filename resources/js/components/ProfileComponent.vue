<template>
    <aside id="column-right" class="col-sm-3 hidden-xs text-right bg-white border mb-3 px-0 pb-0">
        <div class="">
            <ul class="list-item p-0 mb-0">
                <li class="pb-0"><a href="#" class="p-3"  :class="{active_li:isActive('address')}"  @click.prevent="setActive('address')"><i class="fa fa-address-book ml-2"></i>لیست آدرس ها</a></li>
                <li class="pb-0"><a href="" class="p-3" :class="{active_li:isActive('favourite')}"  @click.prevent="setActive('favourite')"><i class="fa fa-list-alt ml-2"></i>لیست علاقه مندی</a></li>
                <li class="pb-0"><a href="" class="p-3" :class="{active_li:isActive('item3')}"  @click.prevent="setActive('item3')"><i class="fa fa-list-alt ml-2"></i>تاریخچه سفارشات</a></li>
                <li class="pb-0"><a href="#" class="p-3"  :class="{active_li:isActive('item4')}"  @click.prevent="setActive('item4')"><i class="fa fa-list-alt ml-2"></i>دانلود ها</a></li>
                <li class="pb-0"><a href="#" class="p-3"  :class="{active_li:isActive('item5')}"  @click.prevent="setActive('item5')"><i class="fa fa-list-alt ml-2"></i>امتیازات خرید</a></li>
                <li class="pb-0"><a href="#" class="p-3"  :class="{active_li:isActive('item6')}"  @click.prevent="setActive('item6')"><i class="fa fa-list-alt ml-2"></i>بازگشت</a></li>
                <li class="pb-0"><a href="#" class="p-3"  :class="{active_li:isActive('item7')}"  @click.prevent="setActive('item7')"><i class="fa fa-list-alt ml-2"></i>تراکنش ها</a></li>
                <li class="pb-0"><a href="#" class="p-3"  :class="{active_li:isActive('news')}"  @click.prevent="setActive('news')"><i class="fa fa-list-alt ml-2"></i>خبرنامه</a></li>
                <li class="pb-0"><a href="#" class="p-3"  :class="{active_li:isActive('payment')}"  @click.prevent="setActive('payment')"><i class="fa fa-list-alt ml-2"></i>پرداخت های تکرار شونده</a></li>
            </ul>
        </div>
    </aside>
</template>

<script>
    export default {
        name: "ProfileComponent",
        data(){
            return{
                activeItem : 'address',
            }
        },
        methods:{
            isActive: function(item){
                return this.activeItem === item;
            },
            setActive: function (item) {
                this.activeItem = item;
            }
        }
    }
</script>

<style scoped>

</style>
