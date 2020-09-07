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
