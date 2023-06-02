<template>
  <div class="wrapper user-login2">
    <div class="login-container container">
      <div class="row">
        <div class="col-md-auto col text-center">
          <div v-if="blank(two_fa_url)" class="login-content text-center text-sm-left">
            <h1 class="text-main h3" v-if="filled(logo)">
              <span class="login-logo d-block d-sm-inline"><!--
              --><img class="mb-3" :src="logo" style="max-height: 42px" alt="" /></span><br><!--
              --><span class="d-block d-sm-inline">{{ array_get(trans, 'title') }}</span>
            </h1>
            <h1 class="text-main h3" v-else>
              <span class="d-block d-sm-inline">{{ array_get(trans, 'title') }}</span>
            </h1>
            <div class="login-form mt-4" @keypress="submitLogin($event)">
              <div class="form-group row">
                <label class="col-auto col-form-label" for="login-username">
                  {{ array_get(trans, 'module.username') }}
                </label>
                <div class="col">
                  <input class="form-control" id="login-username" type="text" autocomplete="off"
                         v-model="login_form.username" required />
                </div>
                <div class="col-auto d-none d-sm-block"><i class="icon-profile-male h2 text-muted"></i></div>
              </div>
              <div class="form-group row">
                <label class="col-auto col-form-label" for="login-password">
                  {{ array_get(trans, 'module.password') }}
                </label>
                <div class="col">
                  <input class="form-control" id="login-password" type="password" autocomplete="off"
                         v-model="login_form.password" required />
                </div>
                <div class="col-auto d-none d-sm-block"><i class="icon-key2 h2 text-muted"></i></div>
              </div>
              <div class="form-group row">
                <label class="col-auto col-form-label" for="login-captcha">
                  {{ array_get(trans, 'module.captcha') }}
                </label>
                <div class="col">
                  <input class="form-control" type="text" id="login-captcha" autocomplete="off"
                         v-model="login_form.captcha" required />
                </div>
                <div class="col-sm-auto d-md-block">
                  <img v-if="filled(captcha_url)" :src="captcha_url"
                       style="width:100px;height:auto;cursor:pointer"
                       alt="" @click="reCaptcha()" />
                </div>
              </div>
              <div class="row align-items-center mt-4">
                <div class="col">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="remember"
                           value="1" v-model="login_form.remember" />
                    <label class="custom-control-label" for="remember">
                      {{ array_get(trans, 'module.remember_me') }}
                    </label>
                  </div>
                </div>

                <div class="col-sm text-md-right col-xs-12 text-center mt-4 mt-md-2">
                  <button v-if="logging" class="btn btn-main btn-lg rounded" type="button" disabled>
                    {{ array_get(trans, 'module.button.logging') }}
                  </button>
                  <button v-else class="btn btn-main btn-lg rounded" type="button" @click="login()">
                    {{ array_get(trans, 'module.button.login') }}
                  </button>
                </div>
              </div>
              <div class="alert alert-danger error fade mt-3" :class="{show: filled(login_error)}" role="alert">
                <span class="text">{{ login_error }}&nbsp;</span>
              </div>
            </div>

          </div>
          <div v-else-if="filled(two_fa_url)" class="login-content text-center text-sm-left">
            <h1 class="text-main h3" v-if="filled(logo)">
              <span class="login-logo d-block d-sm-inline"><!--
              --><img class="mb-3" :src="logo" style="max-height: 42px" alt="" /></span><br><!--
              --><span class="d-block d-sm-inline">{{ array_get(trans, 'title') }}</span>
            </h1>
            <h1 class="text-main h3" v-else>
              <span class="d-block d-sm-inline">{{ array_get(trans, 'title') }}</span>
            </h1>
            <p class="mb-4 my-4" v-if="two_fa_seconds <= 0">{{ array_get(trans, 'module.message.verify_expired') }}</p>
            <p class="mb-4" v-if="two_fa_seconds <= 0">
              <button type="button" class="btn btn-main rounded" @click="resetLogin()">
                {{ array_get(trans, 'module.button.login_again') }}
              </button>
            </p>
            <div class="login-form mt-4" v-if="two_fa_seconds > 0" @keypress="submitVerify($event)">
              <p class="mb-4">{{ verify_timer }}</p>
              <div class="form-group row">
                <label class="col-auto col-form-label" for="login-verify-code">
                  {{ array_get(trans, 'module.verify_code') }}
                </label>
                <div class="col">
                  <input class="form-control" id="login-verify-code" type="text" autocomplete="off"
                         v-model="two_fa_code" required />
                </div>
                <div class="col-auto d-none d-sm-block"><i class="icon-key2 h2 text-muted"></i></div>
              </div>
              <div class="row align-items-center mt-4">
                <div class="col-sm text-md-right col-xs-12 text-center mt-4 mt-md-2">
                  <button type="button" class="btn btn-default btn-lg rounded" @click="resetLogin()">
                    {{ array_get(trans, 'module.button.login_again') }}
                  </button>
                  <button v-if="logging" class="btn btn-main btn-lg rounded" type="button" disabled>
                    {{ array_get(trans, 'module.button.logging') }}
                  </button>
                  <button v-else class="btn btn-main btn-lg rounded" type="button" @click="twoFAVerify()">
                    {{ array_get(trans, 'module.button.verify_login') }}
                  </button>
                </div>
              </div>
              <div class="alert alert-danger error fade mt-3" :class="{show: filled(login_error)}" role="alert">
                <span class="text">{{ login_error }}&nbsp;</span>
              </div>
            </div>

          </div>
        </div>
        <div class="col d-md-block d-none">
          <div class="welcome-panl">
            <h2 class="mb-3">{{ array_get(trans, 'module.topic') }}</h2>
            <p v-html="array_get(trans, 'module.information')"></p>
          </div>
        </div>
      </div>
    </div>
    <div class="login-footer">
      <div class="login-copyright mb-3">
        <p>Copyright © {{ array_get(footer, 'author') }} {{ array_get(footer, 'year') }}</p>
      </div>
    </div>
    <div class="login-bg" v-if="filled(backgrounds)">
      <div class="swiper-container" id="login-swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide" v-for="bg in backgrounds">
            <img :src="bg" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swiper from 'swiper/bundle';
import 'swiper/swiper-bundle.css';

export default {
  name: "SiteLogin",
  props: {
    urls: Object,
    configs: Object
  },
  data() {
    return {
      trans: {},
      footer: {},
      logo: null,
      backgrounds: [],
      captcha_url: null,
      logging: false,
      login_error: null,
      login_form: {
        username: null,
        password: null,
        captcha: null,
        remember: false,
      },
      two_fa_url: null,
      two_fa_seconds: 0,
      two_fa_code: null,
    }
  },
  created() {
    this.getUI();
  },
  mounted() {
  },
  watch: {
    'login_form.username': function (afterVal) {
      if (this.filled(afterVal)) {
        this.login_error = null;
      }
    },
    'login_form.password': function (afterVal) {
      if (this.filled(afterVal)) {
        this.login_error = null;
      }
    },
    'login_form.captcha': function (afterVal) {
      if (this.filled(afterVal)) {
        this.login_error = null;
      }
    },
  },
  computed: {
    verify_timer: function () {
      let text = this.array_get(this.trans, 'module.message.verify_timer');

      if (this.blank(text)) {
        return null;
      }

      if (this.blank(this.two_fa_url)) {
        return text.replace('{0}', '--:--');
      }

      if (this.two_fa_seconds <= 0) {
        return text.replace('{0}', '0:00');
      }

      setTimeout(() => this.two_fa_seconds--, 1000);

      return text.replace('{0}', Math.floor(this.two_fa_seconds / 60) + ':'
        + (this.two_fa_seconds % 60 < 10 ? '0' : '') + (this.two_fa_seconds % 60));
    }
  },
  methods: {
    getUI: function () {
      axios
        .get(this.urls.api_ui)
        .then((response) => {
          this.trans = response.data.data.trans;
          this.footer = response.data.data.footer;
          this.logo = response.data.data.logo;
          this.backgrounds = response.data.data.backgrounds;
        })
        .finally(() => {
          this.reCaptcha();
          this.$nextTick(() => {
            this.applySwiper();
          });
        });
    },
    submitLogin: function ($event) {
      if ($event.keyCode !== 13) {
        return;
      }

      this.login();
    },
    login: function () {
      if (!this.validateLogin()) {
        return;
      }

      let loginForm = Object.assign({}, this.login_form);
      loginForm.username = this.loginEncrypt(loginForm.username, 5);
      loginForm.password = this.loginEncrypt(loginForm.password, 7);

      this.logging = true;

      axios
        .post(this.urls.api_attempt, loginForm)
        .then((response) => {
          if (response.data.code === '0000') {
            if (this.filled(this.array_get(response.data.data, 'redirect_to'))) {
              location.href = response.data.data.redirect_to;
            } else if (this.filled(this.array_get(response.data.data, 'api_two_fa'))) {
              this.two_fa_url = this.array_get(response.data.data, 'api_two_fa');
              this.two_fa_seconds = this.array_get(response.data.data, 'seconds');
              this.two_fa_code = null;
              this.logging = false;
            } else {
              this.logging = false;
            }
          }
        })
        .catch((error) => {
          this.logging = false;
          this.login_error = error.response.data.message;
        })
        .finally(() => {
          if (!this.logging) {
            this.reCaptcha();
          }
        });
    },
    reCaptcha: function () {
      if (this.filled(this.urls.api_captcha)) {
        this.captcha_url = this.urls.api_captcha.replace(/\/$/, '') + '/' + (new Date()).getTime();
      } else {
        this.captcha_url = null;
      }
    },
    applySwiper: function () {
      if (this.filled(this.backgrounds)) {
        new Swiper('#login-swiper', {allowTouchMove: false, autoplay: {delay: 3000}, effect: 'fade', speed: 1000});
      }
    },
    validateLogin: function () {
      if (this.blank(this.login_form.username)) {
        this.login_error = this.array_get(this.trans, 'module.error.username_empty');
        return false;
      } else if (this.blank(this.login_form.password)) {
        this.login_error = this.array_get(this.trans, 'module.error.password_empty');
        return false;
      } else if (this.blank(this.login_form.captcha)) {
        this.login_error = this.array_get(this.trans, 'module.error.captcha_empty');
        return false;
      }

      return true;
    },
    loginEncrypt: function (value, position = 5) {
      if (this.blank(value)) {
        return null;
      }
      let base64 = btoa(escape(value));
      let key = document.head.querySelector('meta[name="csrf-token"]').content;
      return base64.substr(0, position) + key.substr(0, position + 2)
        + base64.substr(position) + key.substr(position + 2);
    },
    resetLogin: function () {
      this.login_form.username = null;
      this.login_form.password = null;
      this.login_form.captcha = null;
      this.two_fa_url = null;
      this.two_fa_code = null;
      this.two_fa_seconds = 0;
      this.logging = false;
      this.login_error = null;
    },
    submitVerify: function ($event) {
      if ($event.keyCode !== 13) {
        return;
      }

      this.twoFAVerify();
    },
    twoFAVerify: function () {
      if (this.blank(this.two_fa_url) || this.blank(this.two_fa_code) || this.two_fa_seconds <= 0) {
        return false;
      }

      this.logging = true;

      axios
        .post(this.two_fa_url, {verify_code: this.two_fa_code})
        .then((response) => {
          if (response.data.code === '0000') {
            if (this.filled(this.array_get(response.data.data, 'redirect_to'))) {
              location.href = response.data.data.redirect_to;
            } else {
              this.logging = false;
            }
          }
        })
        .catch((error) => {
          this.logging = false;
          this.login_error = error.response.data.message;
        })
        .finally(() => {
          if (!this.logging) {
            this.reCaptcha();
          }
        });
    }
  }
}
</script>
