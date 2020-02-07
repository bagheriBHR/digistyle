<template>
    <div class="bg-grey d-flex px-3 pt-3 pb-3">
        <!-- right side -->
        <div class="col-md-2 d-flex flex-column p-0">
            <div class="sidebar pt-2 d-flex flex-column align-items-center p-1 py-2 bg-white">
                <h4 class="w-100 pb-2 text-right pr-3">جستجو در نتایج:</h4>
                <form class="form-inline d-flex pr-2 ">
                    <a @click="search"><img src="/frontend/img/icons8-search-50.png" alt=""></a>
                    <input class="form-control form-control-sm mr-sm-2 py-0 my-0" v-model="searchItem" type="search" placeholder="نام محصول مورد نظر را وارد کنید ..." aria-label="Search">
                </form>
            </div>
            <div class="sidebar p-1 py-2 bg-white pt-2 mt-3">
                <h3 class="w-100 pb-2 text-right pr-2"> فیلتر :</h3>
                <div class=" mt-4 d-flex flex-column align-items-center " v-for="(attributeGroup,index) in attributeGroups">
                        <h4 class="w-100 pb-2 text-right pr-3"> ویژگی {{attributeGroup.name}} :</h4>
                        <select class="form-control form-control-sm col-md-11" @change="addAttribute($event,index)">
                            <option >انتخاب کنید...</option>
                            <option  v-for="value in attributeGroup.attribute_values" :value="value.id">{{value.name}}</option>
                        </select>
                </div>
                <div class="form-group mt-3 ml-3" style="text-align: left">
                    <button type="submit" class="btn btn-danger" @click="getFilterProduct()">اعمال فیلتر</button>
                </div>
            </div>
            <div class="sidebar p-1 py-2 bg-white pt-2 mt-3">
                <h3 class="w-100 pb-2 text-right pr-2"> برند :</h3>
                <div class=" mt-4 d-flex flex-column align-items-center " >
                    <select class="form-control form-control-sm col-md-11" v-model="selected_brand">
                        <option >انتخاب کنید...</option>
                        <option  v-for="brand in brands" :value="brand.id">{{brand.name}}</option>
                    </select>
                </div>
                <div class="form-group mt-3 ml-3" style="text-align: left">
                    <button type="submit" class="btn btn-danger" @click="brandFilterProduct()">اعمال فیلتر</button>
                </div>
            </div>
<!--            <div class="sidebar pt-2 d-flex flex-column align-items-center p-1 py-2 bg-white mt-3">-->
<!--                <div class="d-flex flex-column align-items-center border-bottom pb-2">-->
<!--                    <h4 class="w-100 pb-2 text-right pr-3">کاربرد:</h4>-->
<!--                    <form class="form-inline d-flex pr-2 ">-->
<!--                        <img src="/frontend/img/icons8-search-50.png" alt="">-->
<!--                        <input class="form-control form-control-sm mr-sm-2 py-0 my-0" type="search" placeholder="جستجو کاربرد" aria-label="Search">-->
<!--                    </form>-->
<!--                </div>-->
<!--                <div class="usage d-flex flex-column w-100 pr-2 mt-2">-->
<!--                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">-->
<!--                        <input class="form-check-input m-0" type="checkbox" value=""  >-->
<!--                        <label class="form-check-label mr-3" >-->
<!--                            جعبه جواهرات-->
<!--                        </label>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="sidebar pt-2 d-flex flex-column align-items-center p-1 py-2 bg-white mt-3">-->
<!--                <h4 class="w-100 pb-2 text-right pr-3">جنس:</h4>-->
<!--                <div class=" d-flex flex-column w-100 pr-2 mb-2">-->
<!--                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">-->
<!--                        <input class="form-check-input m-0" type="checkbox" value="" >-->
<!--                        <label class="form-check-label mr-3">-->
<!--                            چوب-->
<!--                        </label>-->
<!--                    </div>-->
<!--                    <div class="form-check w-100 text-right d-flex align-items-center mt-2">-->
<!--                        <input class="form-check-input m-0" type="checkbox" value=""  >-->
<!--                        <label class="form-check-label mr-3">-->
<!--                            فلز-->
<!--                        </label>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="sidebar pt-2 d-flex flex-column align-items-center p-1 py-2 bg-white mt-3">-->
<!--                <h4 class="w-100 pb-2 text-right pr-3">جستجو در رنگ:</h4>-->
<!--                <div class="color d-flex justify-content-right">-->
<!--                    <div class="bg-danger ml-2" ></div>-->
<!--                    <div class="bg-success ml-2" ></div>-->
<!--                    <div class="bg-dark ml-2" ></div>-->
<!--                    <div class="bg-warning ml-2" ></div>-->
<!--                    <div class="bg-info"></div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="sidebar pt-2 d-flex flex-column align-items-start p-2 bg-white mt-3">-->
<!--                <div class="custom-control custom-switch">-->
<!--                    <input type="checkbox" class="custom-control-input">-->
<!--                    <label class="custom-control-label" >فقط کالاهای موجود</label>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="sidebar pt-2 d-flex flex-column align-items-start p-2 bg-white mt-3">-->
<!--                <div class="custom-control custom-switch">-->
<!--                    <input type="checkbox" class="custom-control-input">-->
<!--                    <label class="custom-control-label" >فقط کالاهای آماده ارسال</label>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="sidebar pt-2 d-flex flex-column align-items-center p-1 py-2 bg-white mt-3">-->
<!--                <h4 class="w-100 pb-2 text-right pr-3"> محدوده قیمت مورد نظر:</h4>-->
<!--            </div>-->
        </div>
        <!-- end of right side -->
        <!-- left side -->
        <div class="col-md-10 d-flex flex-column pl-0">
            <div v-if="category" class="category_name text-right mb-2"><h3>{{category.name}}</h3></div>
            <div class="sort d-flex justify-content-start align-items-center">
                <div class="btn-group">
                    <button type="button" onclick="gridView()" class="btn btn-default" title="Grid"><i class="fa fa-th"></i></button>
                    <button type="button" onclick="listView()" class="btn btn-default" title="List"><i class="fa fa-th-list"></i></button>
                </div>
                <div class=" text-right mr-3">
                    <h3 class="control-label mb-0">مرتب سازی :</h3>
                </div>
                <div class="col-sm-2 text-right">
                    <select class="form-control" v-model="sort" @change="getSortedProduct()">
                        <option value="ASC" >قیمت (کم به زیاد)</option>
                        <option value="DESC">قیمت (زیاد به کم)</option>
                    </select>
                </div>
                <div class="col-sm-1 text-right">
                    <h3 class="control-label mb-0" for="input-limit">نمایش :</h3>
                </div>
                <div class="col-sm-2 text-right">
                    <select id="input-limit" class="form-control" v-model="paginate" @change = "getSortedProduct()">
                        <option value="2">4</option>
                        <option value="1">8</option>
                        <option value="4">16</option>
                        <option value="5">32</option>
                        <option value="10">100</option>
                    </select>
                </div>

            </div>
            <!-- products -->
            <div class=" d-flex flex-row flex-wrap">
                <div class="product my-3 bg-white border col-12 col-md-3 p-2 viewType" v-for="product in products.data">
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
            <div class="row mt-3" v-if="products.last_page">
                <div class="d-flex justify-content-center w-100">
                    <paginate
                        v-model = "page"
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
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "ProductComponent",
        props : ['category','brands'],
        data(){
            return{
                products : [],
                sort: 'ASC',
                paginate: 4,
                page : 1,
                attributeGroups : [],
                selected_attributes: [],
                computed_attributes: [],
                flag:false,
                searchFlag:false,
                brandFlag:false,
                searchItem : '',
                selected_brand:'انتخاب کنید...',
            }
        },
        mounted() {
            axios.get('/api/product/' + this.category.id).then(res=>{
                this.products = res.data.products
                console.log(res)
            }).catch(err=>{
                console.log(err)
            })
            axios.get('/api/category-attribute/' + this.category.id).then(res=>{
                this.attributeGroups = res.data.attributeGroups
                console.log(res)
            }).catch(err=>{
                console.log(err)
            })

        },
        methods:{
            clickCallback: function (pageNum) {
                this.products =[];
                if(this.sort == 'ASC' || this.sort == 'DESC'){
                    this.getSortedProduct();
                }else if(this.flag){
                    this.getFilterProduct();
                }else if(this.searchFlag){
                    this.search();
                }else if(this.brandFlag){
                    this.brandFilterProduct();
                }
                else{
                    axios.get('/api/product/' + this.category.id + '?page='+ pageNum).then(res=>{
                        this.products = res.data.products
                        console.log(res)
                    }).catch(err=>{
                        console.log(err)
                    })
                }
            },
            getSortedProduct: function () {
                this.product = [];
                axios.get('/api/sort-product/' + this.category.id + '/' + this.sort + '/' + this.paginate +'?page='+ this.page).then(res=>{
                    this.products = res.data.products
                    console.log(res)
                }).catch(err=>{
                    console.log(err)
                })
            },
            addAttribute: function (event,index) {
                for(var i=0; i< this.selected_attributes.length; i++){
                    var current = this.selected_attributes[i];
                    if(current.index == index){
                        this.selected_attributes.splice(i,1);
                    }
                }
                this.selected_attributes.push({
                    'index' : index,
                    'value' : event.target.value,
                })
                this.computed_attributes = [];
                for(var i=0; i< this.selected_attributes.length; i++){
                    this.computed_attributes.push(this.selected_attributes[i].value);
                }
                console.log(this.computed_attributes)
            },
            getFilterProduct: function () {
                this.product = [];
                this.flag = true;
                var attributes = JSON.stringify(this.computed_attributes) ;
                axios.get('/api/filter-product/' + this.category.id + '/' + this.sort + '/' + this.paginate + '/' + attributes +'?page='+ this.page).then(res=>{
                    this.products = res.data.products
                    console.log(res)
                }).catch(err=>{
                    console.log(err)
                })
            },
            search: function () {
                this.product = [];
                this.searchFlag = true;
                axios.get('/api/search-catProduct/' + this.category.id + '/' + this.searchItem + '/' + this.sort + '/' + this.paginate +'?page='+ this.page).then(res=>{
                    this.products = res.data.products
                    console.log(res)
                }).catch(err=>{
                    console.log(err)
                })
            },
            brandFilterProduct :  function () {
                this.product = [];
                this.brandFlag = true;
                axios.get('/api/brand-filter-product/' + this.category.id + '/' + this.sort + '/' + this.paginate + '/' + this.selected_brand +'?page='+ this.page).then(res=>{
                    this.products = res.data.products
                    console.log(res)
                }).catch(err=>{
                    console.log(err)
                })
            },
        }
    }
</script>

<style scoped>

</style>
