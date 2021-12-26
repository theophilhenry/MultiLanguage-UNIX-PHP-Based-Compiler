#include <bits/stdc++.h>
using namespace std;
typedef long long ll;
#define ff first
#define ss second
#define pb push_back

ll t, x, y;

int main(){
	ios_base::sync_with_stdio(false); cout.tie(NULL); cin.tie(NULL);
	
	cin >> t;
	while(t--){
		cin >> x >> y;
		ll sum = 0;
		for(ll i = 1; i <= x; i++){
			if(i % 5 == 0){
				y = (y * 101) / 100;
			}
			sum += y;
		}
		cout << sum << '\n';
	}
}
