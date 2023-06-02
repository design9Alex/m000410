export default {
  methods: {
    blank: function (value) {
      return typeof value === 'undefined' || value === null || value === ''
        || (Array.isArray(value) && value.length < 1)
        || (typeof value === 'object' && Object.keys(value).length < 1);
    },
    filled: function (value) {
      return !this.blank(value);
    },
    str_is: function (exp, value) {
      if (exp === value) {
        return true;
      }

      let pattern = '^' + exp + '$';
      return (new RegExp(pattern, 'i')).test(value);
    },
    array_get: function (value, key, defaultValue = null) {
      if (!Array.isArray(value) && typeof value !== 'object') {
        return defaultValue !== null ? defaultValue : null;
      }

      let indexQueue = typeof key === 'string' ? key.split('.') : [key];
      let currentIndex = indexQueue.shift();

      if (Array.isArray(value)) {
        if (typeof value[currentIndex] === 'undefined') {
          return defaultValue !== null ? defaultValue : null;
        }

        if (this.blank(indexQueue)) {
          return value[currentIndex];
        } else {
          return this.array_get(value[currentIndex], indexQueue.join('.'));
        }
      }

      if (typeof value === 'object') {
        if (!value.hasOwnProperty(currentIndex)) {
          return defaultValue !== null ? defaultValue : null;
        }

        if (this.blank(indexQueue)) {
          return value[currentIndex];
        } else {
          return this.array_get(value[currentIndex], indexQueue.join('.'));
        }
      }

      return null;
    },
    changeValue: function(key, value){
      this.liveValues[key] = value;
      this.changedValues[key] = value;
    },
  }
}
