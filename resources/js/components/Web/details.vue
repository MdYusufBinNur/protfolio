<template>
    <div>

        <!-- start banner Area -->
        <section class="banner-area relative">
            <div class="container">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="about-content col-lg-12">
                        <h1 class="text-white">
                            Portfolio Details
                        </h1>
                        <p class="link-nav">
						<span class="box">
							<router-link to="/">Home </router-link>
<!--							<a href="portfolio.html">Portfolio</a>-->
							<a href="#?">Portfolio Details</a>
                        </span>
                        </p>

                    </div>
                </div>
            </div>
        </section>
        <!-- End banner Area -->

        <!-- Portfolio Details Area -->
        <section class="portfolio_details_area section-gap">
            <div class="container">
                <div class="portfolio_details_inner">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="left_img">
                                <img class="img-fluid" :src="details.project_image" alt="">
                            </div>
                        </div>
                        <div class="offset-md-1 col-md-5">
                            <div class="portfolio_right_text mt-30">
                                <h4>{{ details.project_name }}</h4>

                                <ul class="list">
                                    <li><span>Rating</span>: <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                        class="fa fa-star"></i></li>
                                    <li><span>Client</span>: {{ details.project_client}}</li>
                                    <li><span>Website</span>: <a :href="details.project_links" target="_blank">{{ details.project_links}}</a></li>
                                    <li><span>Completed</span>: {{ details.project_date}}</li>
                                </ul>
                                <ul class="list social_details">
                                    <li><a href="https://www.facebook.com/mdyusuf375/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://www.linkedin.com/in/yusuf-bin-nur-506402162/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="https://github.com/MdYusufBinNur" target="_blank"><i class="fa fa-github"></i></a></li>
                                    <li><a href="https://www.youtube.com/channel/UC-q4jS4bZ-9Znf5rsxB4AMg?view_as=subscriber" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <p>{{ details.project_details}}</p>
                </div>
            </div>
        </section>
        <!-- End Portfolio Details Area -->


        <!-- Start Contact Area -->
        <section class="contact-area section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-title">
                            <h2>Contact Me</h2>
                            <p>If you're looking for a professional developer you can hire me.</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-80">
                    <div class="col-lg-4 col-md-4">
                        <div class="contact-box">
                            <h4>+88 016 15625375</h4>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="contact-box">
                            <h4>mdyusufbinnur@gmail.com</h4>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="contact-box">
                            <h4>yusufbinnur.com</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <a href="#" class="primary-btn mt-50" data-text="Hire Me">
                            <span>H</span>
                            <span>i</span>
                            <span>r</span>
                            <span>e</span>
                            <span> </span>
                            <span>M</span>
                            <span>e</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Area -->
    </div>
</template>

<script>
    export default {
        data()
        {
            return {
                details: {}
            }
        },
        methods:{
            loadDetails()
            {
                axios.get('api/details/'+this.$route.query.id).then(({data})=>([
                    this.details = data,
                    this.$Progress.finish()
                ]))
            }
        },
        created() {
            this.$Progress.start();
            this.loadDetails()
        }
    }
</script>

<style scoped>

</style>
