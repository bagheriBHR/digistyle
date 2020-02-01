<template>
    <!-- left side -->
    <div class="col-10 d-flex flex-column pl-0">
        <div class="category_name text-right mb-2"><h3>{{category.name}}</h3></div>
        <div class="sort d-flex justify-content-start align-items-center">
            <div class="btn-group">
                <button type="button" onclick="gridView()" class="btn btn-default" title="Grid"><i class="fa fa-th"></i></button>
                <button type="button" onclick="listView()" class="btn btn-default" title="List"><i class="fa fa-th-list"></i></button>
            </div>
            <h3 class="m-0 pr-2 ">مرتب سازی بر اساس:</h3>
            <ul class="d-flex m-0 p-2">
                <li><a href="#" class="px-3">پرفروش ترین</a></li>
                <li><a href="#" class="px-3">جدید ترین</a></li>
                <li><a href="#" class="px-3">محبوب ترین</a></li>
                <li><a href="#" class="px-3">ارزان ترین</a></li>
                <li><a href="#" class="px-3">گران ترین</a></li>
            </ul>
        </div>
        <!-- products -->
        <div class=" d-flex flex-row flex-wrap ">
            <div class="product bg-white border col-12 col-md-3 p-2 viewType" v-for="product in products.data">
                <div class="  d-flex flex-column  align-items-center justify-content-center position-relative py-3 ">
                    <a :href="'http://shop.test/product/' + product.slug" class="text-center"><img :src="'http://shop.test/' + product.photos[0].path" alt="" class="w-50"></a>
                    <a :href="'http://shop.test/product/' + product.slug" class="text-center"><h4 class="my-4">{{product.name}}</h4></a>
                    <p class="price" v-if="product.discount_price"><span class="price-new">{{product.discount_price}} تومان</span> <span class="price-old">{{product.price}} تومان</span><span class="saving">{{Math.round(Math.abs((product.price-product.discount_price)/product.price * 100))}}%</span></p>
                    <h5 v-if="!product.discount_price">تومان {{product.price}}</h5>
                    <div class="saleicon d-flex flex-column justify-content-center align-items-center position-absolute p-2">
                        <a :href="'http://shop.test/add_to_cart/' + product.id"><img src="/frontend/img/icons8-shopping-cart-5022.png" alt="" class="mb-3"></a>
                        <img src="/frontend/img/icons8-heart-5022.png" alt="">
                        <img src="/frontend/img/stuff/icons8-compare-2.png" alt="" class="mt-3">
                    </div>
                </div>
            </div>
        </div>
        <!-- end of products -->
        <div class="row" v-if="products.last_page">
            <div class="d-flex justify-content-center w-100">
                <paginate
                    v-model="page"
                    :page-count="products.last_page"
                    :page-range="3"
                    :margin-pages="2"
                    :click-handler="clickCallback"
                    :prev-text="'قبلی'"
                    :next-text="'بعدی'"
                    :container-class="'pagination'"
                    :page-class="'page-item'">
                </paginate>
            </div>
        </div>
    </div>
    <!-- end of left side -->
</template>

<script>
    import axios from 'axios';
    export default {
        name: "ProductComponent",
        page : '',
        props : ['category'],
        data(){
            return{
                products : [],
            }
        },
        mounted() {
            axios.get('/api/product/' + this.category.id).then(res=>{
                this.products = res.data.products
                console.log(res)
            }).catch(err=>{
                console.log(err)
            })
        },
        methods:{
            clickCallback: function (pageNum) {
                this.products =[];
                axios.get('/api/product/' + this.category.id + '?page='+ pageNum).then(res=>{
                    this.products = res.data.products
                    console.log(res)
                }).catch(err=>{
                    console.log(err)
                })
            }
        }
    }
</script>

<style scoped>

</style>
