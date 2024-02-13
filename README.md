# Alfred Web Search Suggest

Alfred search suggest workflow for various popular websites. Inspired by the official Google Suggest workflow.

## Download & Install

✨ This workflow is available on official Alfred Gallery now! (which means it has been reviewed and verified by Alfred Team ✅)

If you have Alfred 5 or above, you can install and resolve dependencies with one click and enjoy in-app updates in the future.

➡️ [Go to official Alfred Gallery page](https://alfred.app/workflows/zqzten/web-search-suggest/)

If you are still using Alfred 4 or older, you can [download from GitHub releases](https://github.com/zqzten/alfred-web-search-suggest/releases) and install it (just open with Alfred) manually.

## Important Note for macOS Monterey (12.0) and above

Apple has removed the system PHP since macOS Monterey (12.0), so you should install PHP to continue using this workflow.

If you have Alfred 5 or above, you can [let Alfred resolve dependencies automatically](https://www.alfredapp.com/help/kb/dependencies/).

Or you can use [Homebrew](https://brew.sh/) to install PHP manually. After installing Homebrew, you can run the following command in Terminal to install PHP:
```shell
brew install php
```

## Supported Websites

* [Google](#google)
* [Wikipedia](#wikipedia)
* [Wolfram|Alpha](#wolframalpha)
* [Amazon](#amazon)
* [IMDB](#imdb)
* [DuckDuckGo](#duckduckgo)
* [Brave Search](#brave-search)
* [Pixiv](#pixiv)
* [Baidu (百度)](#baidu)
* [Zhihu (知乎)](#zhihu)
* [bilibili (哔哩哔哩)](#bilibili)
* ~~[Sina Weibo (新浪微博)](#sina-weibo)~~
* [Taobao (淘宝)](#taobao)
* [JoyBuy (京东)](#joybuy)
* [Bangumi (番组计划)](#bangumi)
* [Moegirlpedia (萌娘百科)](#moegirlpedia)

## Details

### Google

Support basic suggestions. [Proxy setting](#proxy-setting) is available.

![google](screenshots/google.png)

### Wikipedia

Support direct term suggestions and preview, **language MUST be specified with [ISO 639-1](https://en.wikipedia.org/wiki/ISO_639-1) code in the first arg**. [Proxy setting](#proxy-setting) is available.

![wikipedia-en](screenshots/wikipedia-en.png)

![wikipedia-zh](screenshots/wikipedia-zh.png)

### Wolfram|Alpha

Support direct term suggestions. [Proxy setting](#proxy-setting) is available.

![wolframalpha](screenshots/wolframalpha.png)

### Amazon

Support basic suggestions. [Proxy setting](#proxy-setting) is available.

![amazon](screenshots/amazon.png)

### IMDB

Support direct term suggestions and preview. [Proxy setting](#proxy-setting) is available.

![imdb](screenshots/imdb.png)

### DuckDuckGo

Support basic suggestions. [Proxy setting](#proxy-setting) is available.

![duckduckgo](screenshots/duckduckgo.png)

### Brave Search

Support basic suggestions. [Proxy setting](#proxy-setting) is available.

![bravesearch](screenshots/bravesearch.png)

### Pixiv

Support basic suggestions. [Proxy setting](#proxy-setting) is available.

![pixiv](screenshots/pixiv.png)

### Baidu

Support basic suggestions.

![baidu](screenshots/baidu.png)

### Zhihu

Support basic suggestions.

![zhihu](screenshots/zhihu.png)

### bilibili

Support basic suggestions with personalization.

注：可以在 [User Configuration](https://www.alfredapp.com/help/workflows/user-configuration/)（如果你使用 Alfred 4 及以下版本，则是在 [Environment Variable](https://www.alfredapp.com/help/workflows/advanced/variables/#environment)）中设置你的 bilibili UID 以获得个性化搜索建议。你可以在你的 bilibili 个人主页的个人资料栏找到该 UID。

![bilibili](screenshots/bilibili.png)

### ~~Sina Weibo~~

Removed due to login needed.

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

Support direct term suggestions and preview. [Proxy setting](#proxy-setting) is available.

![moegirlpedia](screenshots/moegirlpedia.png)

## Additional Notes

### Direct Search

If you want an alternative to search exactly what you typed, you can add custom web searches in `Features → Web Search` of Alfred Preferences, here's a list of the search URLs above:

* Google: `built-in`
* Wikipedia: `built-in`
* Wolfram|Alpha: `built-in`
* Amazon: `built-in`
* IMDB: `built-in`
* DuckDuckGo: `built-in`
* Brave Search: `https://search.brave.com/search?q={query}`
* Pixiv: `https://www.pixiv.net/search.php?word={query}`
* Baidu: `https://www.baidu.com/s?wd={query}`
* Zhihu: `https://www.zhihu.com/search?q={query}`
* bilibili: `https://search.bilibili.com/all?keyword={query}`
* Sina Weibo: `https://s.weibo.com/weibo?q={query}`
* Taobao: `https://s.taobao.com/search?q={query}`
* JoyBuy: `https://search.jd.com/Search?enc=utf-8&keyword={query}`
* Bangumi: `http://bangumi.tv/subject_search/{query}`
* Moegirlpedia: `https://zh.moegirl.org.cn/index.php?search={query}`

### Proxy Setting

Proxy setting is avaliable as:

* [User Configuration](https://www.alfredapp.com/help/workflows/user-configuration/) named `Proxy` (for Alfred 5+)
* [Environment Variable](https://www.alfredapp.com/help/workflows/advanced/variables/#environment) named `proxy` (for Alfred 4 and older)

for these websites:

* Google
* Wikipedia
* Wolfram|Alpha
* Amazon
* IMDB
* DuckDuckGo
* Brave Search
* Pixiv
* Moegirlpedia

Here's some example settings:

* If you use an HTTP proxy at `127.0.0.1:1087` without credentials, set `proxy` to `http://127.0.0.1:1087`
* If you use a SOCKS5 proxy at `127.0.0.1:1086` with username `user` and password `pass`, set `proxy` to `socks5://user:pass@127.0.0.1:1086`

For more details, check the [libcurl doc](https://curl.haxx.se/libcurl/c/CURLOPT_PROXY.html).
