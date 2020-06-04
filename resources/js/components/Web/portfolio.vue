<template>
    <div>
        <div v-if="loading === true">
            <div class="preloader-area">
                <div class="loader-box">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
        <!-- start banner Area -->
        <section class="banner-area relative">
            <div class="container">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="about-content col-lg-12">
                        <h1 class="text-white">
                            Portfolio
                        </h1>
                        <p class="link-nav">
						<span class="box">
							<router-link to="/">Home </router-link>
                            <!--							<a href="portfolio.html">Portfolio</a>-->
							<a href="#?">Portfolio</a>
                        </span>
                        </p>

                    </div>
                </div>
            </div>
        </section>
        <!-- End banner Area -->

        <!-- Start Work Area Area -->
        <section class="work-area section-gap-top section-gap-bottom-90" id="work">
            <div class="container">
                <div class="row d-flex justify-content-between align-items-end mb-80">
                    <div class="col-lg-6">
                        <div class="section-title">
                            <h2>Latest Works</h2>
                            <p>Check my latest works.Hopefully you guys like it.</p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="filters">
                            <ul>
                                <li class="active" data-filter=".all">All Categories</li>
                                <li  v-for="category in categories" :key="category.id" :data-filter="'.'+category.name">{{ category.name}}</li>
                                <!--                                <li data-filter=".creative">Creative Work</li>-->
                                <!--                                <li data-filter=".web-design">Web Design</li>-->
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="filters-content" v-for="category in categories">
                    <div class="row grid" >

                        <div v-for="project in category.projects" :class="category.name+' single-work col-lg-4 col-md-6 col-sm-12 all  wow fadeInUp'" data-wow-duration="2s" >
                            <div class="relative">
                                <div class="thumb">
                                    <div class="overlay overlay-bg"></div>
                                    <img class="image img-fluid" :src="project.project_image" alt="">
                                </div>
                                <div class="middle">
                                    <h4>{{ project.project_name}}</h4>
                                    <div class="cat">{{ project.project_name}}</div>
                                </div>
                                <router-link class="overlay"  :to="'/details?id='+ project.id"></router-link>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>
        <!-- End Work Area Area -->


        <!-- Start Job History Area Area -->
        <section class="job-area section-gap-top section-gap-bottom-90">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Job History</h2>
                            <p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see
                                some for as low as $.17 each.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6" v-for="job in jobs">
                        <div class="single-job">

                            <div class="top-sec d-flex justify-content-between">
                                <div class="top-left">
                                    <h4>{{ job.title}}</h4>
                                    <p>{{ job.company}}</p>
                                </div>
                                <div class="top-right">
                                    <a href="#" class="primary-btn" :data-text="job.time_line">
                                        <span>{{ job.time_line}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="bottom-sec wow fadeIn" data-wow-duration="2s">
                                {{ job.description}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Job Historyt Area Area -->


        <!-- Start Service Area -->
        <section class="service-area section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Service Offers</h2>
                            <p>Do you need anything to be done? Lets talk about problem i'll try to give you a digital solution</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="single-service wow fadeInUp" data-wow-duration="1s">
                            <span class="lnr lnr-screen"></span>
                            <h4>
                                <span>Web</span> Design
                            </h4>
                            <p>
                                If you are looking for a web design or software architect design to develop your web
                                application or website then here is the stoppage for you as i can provide practical
                                and reliable solution for your business.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-service wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                            <span class="lnr lnr-laptop-phone"></span>
                            <h4><span>Android App</span> Development
                            </h4>
                            <p>
                                If you are looking for a Android App Developer to develop your Android
                                Application then here is the stoppage for you.I can develop your app with
                                push notification, google maps, live chat etc.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-service wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
                            <span class="lnr lnr-database"></span>
                            <h4><span>Web</span> Development
                            </h4>
                            <p>
                                If you are looking for a web design or software architect design to develop your web
                                application or website then here is the stoppage for you as i can provide practical
                                and reliable solution for your business.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-service wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">
                            <span class="lnr lnr-chart-bars"></span>
                            <h4><span>Graphics</span> Design
                            </h4>
                            <p>
                                If you are looking for a graphics designer for your business i can manage it as i have my team.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Service Area -->


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
    $(".preloader-area").delay(200).fadeOut(500);
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
                loading: true,
            }
        },
        methods:
            {
                loadAbout()
                {
                    // axios.get('api/web').then(({data})=>([
                    //     this.about_title = data.about.title,
                    //     this.about_description = data.about.description,
                    //     this.about_image = data.about.image,
                    //     this.categories = data.categories,
                    //     this.jobs = data.jobs,
                    //     this.$Progress.finish(),
                    // ]))
                    axios.get('api/web').then(({data}) =>
                    {
                        if (data) {
                            this.about_title = data.about.title,
                                this.about_description = data.about.description,
                                this.about_image = data.about.image,
                                this.categories = data.categories,
                                this.jobs = data.jobs,
                                this.$Progress.finish(),
                                this.loading = false;
                        } else {
                            this.message = 'No logs to display';
                            this.loading = false;
                        }
                    })
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
