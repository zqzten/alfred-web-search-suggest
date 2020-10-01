# Alfred Web Search Suggest

Alfred Web Search suggest workflow for various popular websites. Inspired by the official Google Suggest workflow.

[**DOWNLOAD**](https://github.com/AkikoZ/alfred-web-search-suggest/releases)

## Supported Websites

* [Google](#google)
* [Wikipedia](#wikipedia)
* [Wolfram|Alpha](#wolframalpha)
* [Amazon](#amazon)
* [Pixiv](#pixiv)
* [Baidu (百度)](#baidu)
* [Zhihu (知乎)](#zhihu)
* [bilibili (哔哩哔哩)](#bilibili)
* [Sina Weibo (新浪微博)](#sina-weibo)
* [Taobao (淘宝)](#taobao)
* [JoyBuy (京东)](#joybuy)
* [Bangumi (番组计划)](#bangumi)
* [Moegirlpedia (萌娘百科)](#moegirlpedia)

## Details

### Google

Support basic suggestions. [Proxy setting](#proxy-setting) is available in the workflow environment variables.

![google](screenshots/google.png)

### Wikipedia

Support direct term suggestions and preview, language can be specified with [ISO 639-1](https://en.wikipedia.org/wiki/ISO_639-1) code in the first arg. [Proxy setting](#proxy-setting) is available in the workflow environment variables.

![wikipedia-en](screenshots/wikipedia-en.png)

![wikipedia-zh](screenshots/wikipedia-zh.png)

### Wolfram|Alpha

Support direct term suggestions. [Proxy setting](#proxy-setting) is available in the workflow environment variables.

![wolframalpha](screenshots/wolframalpha.png)

### Amazon

Support basic suggestions. [Proxy setting](#proxy-setting) is available in the workflow environment variables.

![amazon](screenshots/amazon.png)

### Pixiv

Support basic suggestions. [Proxy setting](#proxy-setting) is available in the workflow environment variables.

![pixiv](screenshots/pixiv.png)

### Baidu

Support basic suggestions.

![baidu](screenshots/baidu.png)

### Zhihu

Support basic suggestions.

![zhihu](screenshots/zhihu.png)

### bilibili

Support basic suggestions.

![bilibili](screenshots/bilibili.png)

### Sina Weibo

Support basic suggestions.

![sinaweibo](screenshots/sinaweibo.png)

### Taobao

Support basic suggestions.

![taobao](screenshots/taobao.png)

### JoyBuy

Support basic suggestions.

![joybuy](screenshots/joybuy.png)

### Bangumi

Support direct term suggestions and preview, type can be specified in the first arg.

注：共支持 6 种条目类型的搜索，分别为全部（all）、动画（anime）、书籍（book）、音乐（music）、游戏（game）、三次元（real）；对于每一条搜索结果，副标题默认显示该条目的类型（如果当前搜索类型为全部）和中文名称（若有），按 **⌘** 可显示其简介（若有），按 **⌃** 可显示其排名与评分（若有）。

![bangumi-all](screenshots/bangumi-all.png)

![bangumi-anime](screenshots/bangumi-anime.png)

### Moegirlpedia

Support direct term suggestions and preview.

![moegirlpedia](screenshots/moegirlpedia.png)

## Additional Notes

### Direct Search

If you want an alternative to search exactly what you typed, you can add custom web searches in `Features → Web Search` of Alfred Preferences, here's a list of the search URLs above:

* Google: `built-in`
* Wikipedia: `built-in`
* Wolfram|Alpha: `built-in`
* Amazon: `built-in`
* Pixiv: `https://www.pixiv.net/search.php?word={query}`
* Baidu: `https://www.baidu.com/s?wd={query}`
* Zhihu: `https://www.zhihu.com/search?q={query}`
* bilibili: `https://search.bilibili.com/all?keyword={query}`
* Sina Weibo: `https://s.weibo.com/weibo?q={query}`
* Taobao: `https://s.taobao.com/search?q={query}`
* JoyBuy: `https://search.jd.com/Search?enc=utf-8&keyword={query}`
* Bangumi: `http://bangumi.tv/subject_search/{query}`
* Moegirlpedia: `https://zh.moegirl.org/?search={query}`

### Proxy Setting

Proxy setting is avaliable in the workflow environment variables as `proxy`, here's some example settings:

* If you use an HTTP proxy at `127.0.0.1:1087` without credentials, set `proxy` to `http://127.0.0.1:1087`
* If you use a SOCKS5 proxy at `127.0.0.1:1086` with username `user` and password `pass`, set `proxy` to `socks5://user:pass@127.0.0.1:1086`

For more details, check the [libcurl doc](https://curl.haxx.se/libcurl/c/CURLOPT_PROXY.html).
