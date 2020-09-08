# 签到小程序

# 接口文档

公共入参结构

|  字段   |  类型  |        备注         |  位置  |
| :-----: | :----: | :-----------------: | :----: |
| X-Token | string | 用户授权登录的TOKEN | Header |

公共返回结构

| 字段  |  类型  |     备注     |
| :---: | :----: | :----------: |
| code  |  int   | 错误码 0正常 |
| data  | object |     数据     |

## 用户相关

### 注册

> POST /user/register

- 请求参数

|   字段   |  类型  |            备注            |
| :------: | :----: | :------------------------: |
| username | string |           用户名           |
| password | string | 密码 需要经过一次 md5 转化 |

- 返回参数

| 字段  |  类型  |   备注    |
| :---: | :----: | :-------: |
| token | string | 授权TOKEN |
| registed | bool | 是否完成注册 |

### 登录

> POST /user/login

- 请求参数

|   字段   |  类型  |            备注            |
| :------: | :----: | :------------------------: |
| username | string |           用户名           |
| password | string | 密码 需要经过一次 md5 转化 |

- 返回参数

| 字段  |  类型  |   备注    |
| :---: | :----: | :-------: |
| token | string | 授权TOKEN |
| registed | bool | 是否完成注册 |

### 微信登录

> POST /user/wxlogin

- 请求参数

|   字段   |  类型  |            备注            |
| :------: | :----: | :------------------------: |
| token | string |           小程序授权TOKEN           |

- 返回参数

| 字段  |  类型  |   备注    |
| :---: | :----: | :-------: |
| token | string | 授权TOKEN |
| registed | bool | 是否完成注册 |

### 完成注册

> POST /user/fin-register

- 请求参数

|   字段   |  类型  |            备注            |
| :------: | :----: | :------------------------: |
| username | string |           用户名           |

### 用户详情

> GET /user/info

- 返回参数

| 字段  |  类型  |   备注    |
| :---: | :----: | :-------: |
| id | int | 用户ID |
| username | string | 用户登录名 |
| nickname | string | 用户昵称 |
| mobile | string | 手机号 |
| wechat_code | string | 微信号 |
| profession | string | 职业 |
| gender | int | 0未知 1男 2女 |
| head_img | string | 头像 |
