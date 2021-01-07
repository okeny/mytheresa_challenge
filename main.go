package main

import (
	"fmt"
	//"log"
	"github.com/gorilla/mux"
	"net/http"
)

func main(){

	router := mux.NewRouter()
	router.HandleFunc("/", func(rw http.ResponseWriter, r *http.Request){

	})
	fmt.Println("nice work")
}