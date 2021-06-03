import axios,  { AxiosInstance } from 'axios';
import camelcaseKeys from 'camelcase-keys';

export interface ApiConfig {
  baseURL?: string;
  headers?: object;
  withCredentials?: boolean;
  timeout?: number;
  responseEncoding?: string;
}


const defaultConfig: ApiConfig = {

  baseURL: 'http://localhost/api/',
  headers: { 'Content-Type': 'application/json' },
  timeout: 1000 * 10

};

export const createAxiosInstance = (optionalConfig: ApiConfig): AxiosInstance => {
  const config = {
      ...defaultConfig,
      ...optionalConfig,
  };

  const instance = axios.create(config);
  
  instance.interceptors.response.use(
    (res) => ({
      ...res,
      data: camelcaseKeys(res.data, { deep: true }),
    })
  );
  return instance;
};
