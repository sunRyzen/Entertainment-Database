import java.net.HttpURLConnection;
import java.net.URL;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.Statement;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import org.json.JSONObject;
import org.json.JSONArray;
import java.sql.*;


public class ItunesApi {

 public static void main(String[] args) {
	 
	 String sqlurl = "jdbc:mysql://sql9.freemysqlhosting.net:3306/sql9611840";
	 String user = "sql9611840";
	 String password = "n74TrMNk2r";
	 
  try {
   URL url = new URL("https://itunes.apple.com/search?term=all&entity=song&limit=200");
   HttpURLConnection conn = (HttpURLConnection) url.openConnection();
   conn.setRequestMethod("GET");
   conn.setRequestProperty("Accept", "application/json");

   if (conn.getResponseCode() != 200) {
    throw new RuntimeException("Failed : HTTP error code : "
      + conn.getResponseCode());
   }

   BufferedReader br = new BufferedReader(new InputStreamReader(
     (conn.getInputStream())));

   String output;
   String jsonString = "";
   while ((output = br.readLine()) != null) 
   {
    jsonString += output;
   }

   Connection myConn = DriverManager.getConnection(sqlurl, user, password);
   String sql = "INSERT INTO itunesapi (artist_name, track_name, release_date, explicitness, primary_genre, track_url) " + "VALUES (?,?,?,?,?,?)";
   PreparedStatement stmt = myConn.prepareStatement(sql);

   JSONObject json = new JSONObject(jsonString);
   JSONArray results = json.getJSONArray("results");
   for (int i = 0; i < results.length(); i++)
   {
    JSONObject res = results.getJSONObject(i);
    stmt.setString(1, res.getString("artistName"));
    stmt.setString(2, res.getString("trackName"));
    stmt.setString(3, res.getString("releaseDate"));
    stmt.setString(4, res.getString("trackExplicitness"));
    stmt.setString(5, res.getString("primaryGenreName"));
    stmt.setString(6, res.getString("trackViewUrl"));
    stmt.executeUpdate();
   }
   
   System.out.println("Insert complete.");
   
   conn.disconnect();

  } catch (Exception e) {
   e.printStackTrace();
  }
  
  

 }

}
