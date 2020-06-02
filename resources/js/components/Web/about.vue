<template>
    <div>
        <!-- start banner Area -->
        <section class="banner-area relative">
            <div class="container">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="about-content col-lg-12">
                        <h1 class="text-white">
                           Abouts
                        </h1>
                        <p class="link-nav">
						<span class="box">
							<router-link to="/">Home </router-link>
                            <!--							<a href="portfolio.html">Portfolio</a>-->
							<a href="#?">About</a>
                        </span>
                        </p>

                    </div>
                </div>
            </div>
        </section>
        <!-- End banner Area -->

        <!-- Start About Area -->
        <section class="about-area section-gap">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 about-left">
                        <img class="img-fluid" :src="about_image" alt="">
                    </div>
                    <div class="col-lg-5 col-md-12 about-right">
                        <div class="section-title">
                            <h2>{{ about_title }}</h2>
                        </div>
                        <div class="mb-50 wow fadeIn" data-wow-duration=".8s">
                            <p>
                                {{ about_description}}
                            </p>
                        </div>
                        <a href="#" class="primary-btn white" data-text="More Info">
                            <span>M</span>
                            <span>o</span>
                            <span>r</span>
                            <span>e</span>
                            <span> </span>
                            <span>I</span>
                            <span>n</span>
                            <span>f</span>
                            <span>o</span>
                        </a>
                        <a href="#" class="primary-btn" data-text="Resume">
                            <span>R</span>
                            <span>e</span>
                            <span>s</span>
                            <span>u</span>
                            <span>m</span>
                            <span>e</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Area -->

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
        data(){
            return {
                abouts: {},
                categories: {},
                about_title:'',
                about_description:'',
                about_image:'',
                projects: {},
                jobs: {},
            }
        },
        methods:
            {
                loadAbout()
                {
                    axios.get('api/web').then(({data})=>([
                        this.about_title = data.about.title,
                        this.about_description = data.about.description,
                        this.about_image = data.about.image,
                        this.categories = data.categories,
                        this.jobs = data.jobs,
                        this.$Progress.finish()
                    ]))
                }
            },
        created() {
            this.$Progress.start();
            this.loadAbout();
        }

    }
</script>

<style scoped>

</style>
