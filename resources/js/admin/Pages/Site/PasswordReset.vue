<template>
  <div class="wrapper user-login2">
    <div class="login-container container">
      <div class="row">
        <div class="col-md-auto col text-center">
          <div class="login-content text-center text-sm-left">
            <h1 class="text-main h3" v-if="filled(logo)">
              <span class="login-logo d-block d-sm-inline"><!--
              --><img class="mb-3" :src="logo" style="max-height: 42px" alt="" /></span><br><!--
              --><span class="d-block d-sm-inline">{{ array_get(trans, 'title') }}</span>
            </h1>
            <h1 class="text-main h3" v-else>
              <span class="d-block d-sm-inline">{{ array_get(trans, 'title') }}</span>
            </h1>
            <div class="login-form mt-4" @keypress="submitPassword($event)">
              <div class="form-group row">
                <label class="col-auto col-form-label" for="password-reset-password">
                  {{ array_get(trans, 'module.password') }}
                </label>
                <div class="col">
                  <input class="form-control" id="password-reset-password" type="password" autocomplete="off"
                         v-model="reset_form.password" required />
                </div>
                <div class="col-auto d-none d-sm-block"><i class="icon-key2 h2 text-muted"></i></div>
              </div>
              <div class="form-group row">
                <label class="col-auto col-form-label" for="password-reset-password_confirmation">
                  {{ array_get(trans, 'module.password_confirmation') }}
                </label>
                <div class="col">
                  <input class="form-control" id="password-reset-password_confirmation" type="password" autocomplete="off"
                         v-model="reset_form.password_confirmation" required />
                </div>
                <div class="col-auto d-none d-sm-block"><i class="icon-message-typing h2 text-muted"></i></div>
              </div>
              <div class="row align-items-center mt-4">
                <div class="col-sm text-md-right col-xs-12 text-center mt-4 mt-md-2">
                  <a class="btn btn-secondary btn-lg rounded" :class="{disabled: updating}" :href="urls.logout">
                    {{ array_get(trans, 'module.button.logout') }}
                  </a>
                  <button v-if="updating" class="btn btn-main btn-lg rounded" type="button" disabled>
                    {{ array_get(trans, 'module.button.updating') }}
                  </button>
                  <button v-else class="btn btn-main btn-lg rounded" type="button" @click="resetPassword()">
                    {{ array_get(trans, 'module.button.update') }}
                  </button>
                </div>
              </div>
              <div class="alert alert-danger error fade mt-3" :class="{show: filled(reset_error)}" role="alert">
                <span class="text">{{ reset_error }}&nbsp;</span>
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
  name: "SitePasswordReset",
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
      updating: false,
      reset_error: null,
      reset_form: {
        password: null,
        password_confirmation: null,
      }
    }
  },
  created() {
    this.getUI();
  },
  mounted() {
  },
  watch: {
    'reset_form.password': function (afterVal) {
      if (this.filled(afterVal)) {
        this.reset_error = null;
      }
    },
    'reset_form.password_confirmation': function (afterVal) {
      if (this.filled(afterVal)) {
        this.reset_error = null;
      }
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
          this.$nextTick(() => {
            this.applySwiper();
          });
        });
    },
    submitPassword: function ($event) {
      if ($event.keyCode !== 13) {
        return;
      }

      this.resetPassword();
    },
    resetPassword: function () {
      let resetForm = Object.assign({}, this.reset_form);
      resetForm.password = this.passwordEncrypt(resetForm.password, 7);
      resetForm.password_confirmation = this.passwordEncrypt(resetForm.password_confirmation, 10);

      this.updating = true;

      axios
        .put(this.urls.api_update, resetForm)
        .then((response) => {
          if (response.data.code === '0000') {
            if (this.filled(this.array_get(response.data.data, 'redirect_to'))) {
              location.href = response.data.data.redirect_to;
            } else {
              this.updating = false
              this.reset_error = response.data.message;
            }
          }
        })
        .catch((error) => {
          this.updating = false;
          this.reset_error = error.response.data.message;
        });
    },
    applySwiper: function () {
      if (this.filled(this.backgrounds)) {
        new Swiper('#login-swiper', {allowTouchMove: false, autoplay: {delay: 3000}, effect: 'fade', speed: 1000});
      }
    },
    passwordEncrypt: function (value, position = 5) {
      if (this.blank(value)) {
        return null;
      }
      let base64 = btoa(escape(value));
      let key = document.head.querySelector('meta[name="csrf-token"]').content;
      return base64.substr(0, position) + key.substr(0, position + 2)
        + base64.substr(position) + key.substr(position + 2);
    }
  }
}
</script>
