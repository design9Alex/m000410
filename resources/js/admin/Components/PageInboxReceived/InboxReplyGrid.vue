<template>
  <section class="panel panel-default">
    <header class="panel-heading">
      <h1 class="h5 float-left font-weight-bold">{{ array_get(trans, 'ui.topic.inbox_replied') }}</h1>
    </header>
    <div class="panel-wrapper">
      <div class="panel-body">
        <div v-for="reply in reply_list"
             class="card mb-2"
             :class="{'border-dark': !reply.replier_self}"
             :id="'reply-' + reply.serial">
          <div class="card-header">
            <div class="row no-gutters">
              <div class="col-sm">
                <p class="mb-0">
                  <span class="badge badge-danger mr-2">{{ reply.replier_tag }}</span><!--
                    --><strong class="text-dark">{{ reply.replier_name }}</strong><!--
                    --><span class="text-muted small ml-2">( {{ reply.replier_username }} )</span>
                </p>
                <p v-if="filled(reply.sent_to)" class="mb-0 small text-muted">
                  <span class="mr-2">{{ array_get(trans, 'ui.topic.reply_text.reply_to') }}</span>{{ reply.sent_to }}
                </p>
                <p v-if="filled(reply.sent_bcc)" class="mb-0 small text-muted">
                  <span class="mr-2">{{ array_get(trans, 'ui.topic.reply_text.bcc') }}</span>{{ reply.sent_bcc }}
                </p>
              </div>
              <div class="col-sm-auto text-sm-right">
                <p class="mb-0 form-text small text-muted">{{ reply.created_at }}</p>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="text" v-html="reply.content"></div>
            <hr>
            <div class="text-right">
              <span :class="{'text-muted': !reply.visible}">
                <i class="icon-eye mr-2"></i><!--
                -->{{ array_get(trans, 'ui.topic.reply_text.visible_' + (reply.visible ? 1 : 0)) }}
              </span>
              <span v-if="filled(reply.sent_url) && reply.sent_url !== '#'" class="ml-2">
                <i class="icon-mail mr-2"></i><!--
                --><a :href="reply.sent_url" target="_blank">{{ array_get(trans, 'ui.topic.reply_text.notify_1') }}</a>
              </span>
              <span v-else-if="filled(reply.sent_url)" class="ml-2">
                <i class="icon-mail mr-2"></i>{{ array_get(trans, 'ui.topic.reply_text.notify_1') }}
              </span>
              <span v-else class="ml-2 text-muted">
                <i class="icon-mail mr-2"></i>{{ array_get(trans, 'ui.topic.reply_text.notify_0') }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "InboxReplyGrid",
  props: ['urls', 'trans'],
  data() {
    return {
      reply_list: []
    }
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData: function () {
      if (this.filled(this.urls.api_grid)) {
        axios
          .post(this.urls.api_grid)
          .then((response) => {
            this.reply_list = response.data.data.data;
            this.$nextTick(() => {
              if (this.reply_list.length) {
                let targetId = 'reply-' + this.reply_list[this.reply_list.length - 1].serial;
                let target = document.getElementById(targetId);
                setTimeout(() => {
                  window.scrollTo({"top": target.offsetTop - 60, "behavior": "smooth"});
                }, 700);
              }
            });
          });
      }
    }
  }
}
</script>
